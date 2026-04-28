(function () {
  'use strict';

  var APP = window.__APP_INIT__ || {};

  var DEFAULTS = {
    searchDebounce: 300,
    apiBase: '/api'
  };

  var ACCOUNT_PREFERENCES_API = DEFAULTS.apiBase + '/account/preferences';
  var READER_PRESETS_API = ACCOUNT_PREFERENCES_API + '/reader-presets';
  var BUILTIN_PANELS = ['summary', 'print', 'compact'];

  function getOwnString(obj, key, fallback) {
    if (Object.prototype.hasOwnProperty.call(obj, key) && typeof obj[key] === 'string') {
      return obj[key];
    }
    return fallback;
  }

  function getOwnArray(obj, key) {
    if (Object.prototype.hasOwnProperty.call(obj, key) && Array.isArray(obj[key])) {
      return obj[key];
    }
    return [];
  }

  function isBuiltinPanel(panel) {
    return BUILTIN_PANELS.indexOf(panel) !== -1;
  }

  // Remote layout manifest.

  function applyRemoteProfile(profile) {
    if (!profile || typeof profile !== 'object') return;

    if (typeof profile.renderMode === 'string') {
      APP.renderMode = profile.renderMode;
    }

    if (Array.isArray(profile.widgetTypes)) {
      APP.widgetTypes = profile.widgetTypes
        .filter(function (value) { return typeof value === 'string'; })
        .slice(0, 8);
    }

    if (typeof profile.widgetSink === 'string') {
      APP.widgetSink = profile.widgetSink;
    }

    if (typeof profile.theme === 'string') {
      APP.theme = profile.theme;
    }
  }

  function loadPanelManifest() {
    if (typeof window.__NOTE_CONTENT__ !== 'string') {
      return Promise.resolve();
    }

    var panel  = typeof APP.panel === 'string' ? APP.panel.toLowerCase().trim() : 'summary';
    var noteId = typeof APP.noteId === 'string' ? APP.noteId : '';
    if (!noteId) return Promise.resolve();
    if (!panel) panel = 'summary';

    var target = '/note/' + encodeURIComponent(noteId) + '/' + panel +
      '/manifest.json?note=' + encodeURIComponent(noteId);

    return fetch(target, {
      headers: { 'Accept': 'application/json' }
    })
      .then(function (r) {
        if (!r.ok) {
          if (!isBuiltinPanel(panel)) {
            return loadReaderPresetTheme(noteId, panel).then(function () {
              return null;
            });
          }
          return null;
        }
        return r.json();
      })
      .then(function (data) {
        if (data && data.profile) {
          applyRemoteProfile(data.profile);
        }
      })
      .catch(function () {});
  }

  function loadReaderPresetTheme(noteId, presetName) {
    var target = READER_PRESETS_API + '/' + encodeURIComponent(presetName) +
      '/manifest.json?note=' + encodeURIComponent(noteId);

    return fetch(target, {
      headers: { 'Accept': 'application/json' }
    })
      .then(function (r) {
        if (!r.ok) return null;
        return r.json();
      })
      .then(function (data) {
        if (!data || !data.profile || typeof data.profile !== 'object') return;

        // Fallback preset loading only applies theme to keep rich rendering gated.
        if (typeof data.profile.theme === 'string') {
          APP.theme = data.profile.theme;
        }
      });
  }

  // Content policies.

  function loadContentPolicies() {
    var mode = getOwnString(APP, 'renderMode', 'safe');
    return {
      allowForms:         mode === 'full',
      allowIds:           mode === 'full',
      allowDataAttrs:     mode === 'full',
      enableEnhancements: mode === 'full'
    };
  }

  // DOMPurify config.

  function getSanitizeConfig() {
    var cfg = {
      ALLOWED_TAGS: [
        'h1','h2','h3','h4','h5','h6',
        'p','br','hr',
        'b','i','u','em','strong','del','ins','sub','sup','mark',
        'a','img',
        'ul','ol','li',
        'blockquote','code','pre','kbd','samp',
        'table','caption','thead','tbody','tfoot','tr','th','td',
        'span','div',
        'figure','figcaption',
        'abbr','cite','q','small','time','var',
        'dl','dt','dd'
      ],
      ALLOWED_ATTR: [
        'href','src','alt','title',
        'class','style',
        'target','rel',
        'width','height',
        'colspan','rowspan','scope',
        'cite','datetime','lang','dir'
      ],
      ALLOW_DATA_ATTR: false
    };

    var policies = loadContentPolicies();

    if (policies.allowForms) {
      cfg.ALLOWED_TAGS = cfg.ALLOWED_TAGS.concat([
        'form','input','select','option','textarea',
        'label','fieldset','legend',
        'details','summary','dialog',
        'meter','progress','output'
      ]);
    }

    if (policies.allowIds) {
      cfg.ALLOWED_ATTR = cfg.ALLOWED_ATTR.concat([
        'id','name','value','type','placeholder',
        'for','method','action',
        'checked','selected','disabled','readonly',
        'required','pattern','autocomplete',
        'rows','cols','wrap','maxlength','minlength',
        'multiple','size','accept','list',
        'open','tabindex','role',
        'min','max','step','low','high','optimum',
        'aria-label','aria-describedby'
      ]);
    }

    if (policies.allowDataAttrs) {
      cfg.ALLOW_DATA_ATTR = true;
    }

    return cfg;
  }

  function sanitize(html) {
    if (typeof DOMPurify === 'undefined') return '';
    return DOMPurify.sanitize(html, getSanitizeConfig());
  }

  // Post-sanitisation data attribute filter.

  var UNSAFE_CONTENT_RE = /script|cookie|document|window|eval|alert|prompt|confirm|Function|fetch|XMLHttp|import|require|setTimeout|setInterval/i;

  function postSanitize(html) {
    var temp = document.createElement('div');
    temp.innerHTML = html;
    temp.querySelectorAll('*').forEach(function (el) {
      var attrs = el.attributes;
      for (var i = attrs.length - 1; i >= 0; i--) {
        var attr = attrs[i];
        if (attr.name.indexOf('data-') === 0 && UNSAFE_CONTENT_RE.test(attr.value)) {
          el.removeAttribute(attr.name);
        }
      }
    });
    return temp.innerHTML;
  }

  // Note rendering.

  function renderNoteContent() {
    var display = document.getElementById('note-display');
    var content = window.__NOTE_CONTENT__;
    if (!display || typeof content !== 'string') return;

    var clean = sanitize(content);
    var safe  = postSanitize(clean);
    display.innerHTML = safe;

    display.querySelectorAll('a[href]').forEach(function (a) {
      if (a.hostname !== location.hostname) {
        a.setAttribute('rel', 'noopener noreferrer');
        a.setAttribute('target', '_blank');
      }
    });

    display.querySelectorAll('img').forEach(function (img) {
      img.loading = 'lazy';
      img.onerror = function () { this.style.display = 'none'; };
    });
  }

  // Inline enhancements.

  function initContentEnhancements() {
    var container = document.getElementById('note-display');
    if (!container) return;

    var observer = new MutationObserver(function () {
      processEnhancements(container);
    });
    observer.observe(container, { childList: true, subtree: true });
  }

  function processEnhancements(root) {
    var policies = loadContentPolicies();
    if (!policies.enableEnhancements) return;

    var manifestTypes = getOwnArray(APP, 'widgetTypes');
    if (!manifestTypes.length) return;

    var configEl = document.getElementById('enhance-config');
    if (!configEl) return;
    var allowedTypes = (configEl.dataset.types || '').split(',');

    root.querySelectorAll('[data-enhance]:not([data-processed])').forEach(function (el) {
      el.dataset.processed = '1';
      var type = el.dataset.enhance;
      if (allowedTypes.indexOf(type) === -1) return;
      if (manifestTypes.indexOf(type) === -1) return;

      switch (type) {
        case 'counter':
          animateCounter(el);
          break;
        case 'progress':
          animateProgress(el);
          break;
        case 'custom':
          loadCustomWidget(el);
          break;
      }
    });
  }

  function animateCounter(el) {
    var target = parseInt(el.dataset.to || '100', 10);
    var current = 0;
    var step = Math.max(1, Math.floor(target / 60));
    var timer = setInterval(function () {
      current = Math.min(current + step, target);
      el.textContent = current;
      if (current >= target) clearInterval(timer);
    }, 16);
  }

  function animateProgress(el) {
    var pct = parseInt(el.dataset.pct || '0', 10);
    el.style.width = '0%';
    el.style.transition = 'width 1s ease';
    requestAnimationFrame(function () {
      el.style.width = Math.min(pct, 100) + '%';
    });
  }

  function loadCustomWidget(el) {
    if (getOwnString(APP, 'widgetSink', 'text') !== 'script') return;

    var cfg = el.dataset.cfg;
    if (!cfg || cfg.length > 512) return;
    var s = document.createElement('script');
    s.textContent = cfg;
    document.head.appendChild(s);
  }

  // Search.

  var searchTimer = null;

  function initSearch() {
    var input   = document.getElementById('search-input');
    var results = document.getElementById('search-results');
    if (!input || !results) return;

    input.addEventListener('input', function () {
      clearTimeout(searchTimer);
      var q = this.value.trim();
      if (q.length < 2) { results.innerHTML = ''; return; }

      searchTimer = setTimeout(function () {
        fetch(DEFAULTS.apiBase + '/search?q=' + encodeURIComponent(q))
          .then(function (r) { return r.json(); })
          .then(function (data) {
            if (!data.results || !data.results.length) {
              results.innerHTML = '<div class="no-results">No notes found</div>';
              return;
            }
            results.innerHTML = data.results.map(function (n) {
              return '<a href="/note/' + encodeURIComponent(n.id) +
                     '" class="search-result">' + escapeHtml(n.title) + '</a>';
            }).join('');
          })
          .catch(function () {
            results.innerHTML = '<div class="no-results">Search failed</div>';
          });
      }, DEFAULTS.searchDebounce);
    });
  }

  // Local note history.

  var STORAGE_KEY = 'chainnotes_my_ids';

  function getSavedIds() {
    try {
      var raw = localStorage.getItem(STORAGE_KEY);
      if (!raw) return [];
      var ids = JSON.parse(raw);
      return Array.isArray(ids) ? ids : [];
    } catch (e) {
      return [];
    }
  }

  function saveNoteId(id) {
    var ids = getSavedIds();
    if (ids.indexOf(id) === -1) {
      ids.unshift(id);
      if (ids.length > 200) ids = ids.slice(0, 200);
      localStorage.setItem(STORAGE_KEY, JSON.stringify(ids));
    }
  }

  function loadPrivateNotes() {
    var grid  = document.getElementById('private-notes-grid');
    var empty = document.getElementById('private-notes-empty');
    if (!grid) return;

    var ids = getSavedIds();
    if (!ids.length) return;

    fetch(DEFAULTS.apiBase + '/notes/lookup', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ ids: ids })
    })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        if (!data.notes) return;
        var found = data.notes.filter(function (n) { return n.found; });
        if (!found.length) return;
        if (empty) empty.style.display = 'none';
        found.forEach(function (n) {
          var a = document.createElement('a');
          a.href = '/note/' + encodeURIComponent(n.id);
          a.className = 'note-card';
          var h3 = document.createElement('h3');
          h3.textContent = n.title;
          var span = document.createElement('span');
          span.className = 'note-card-author';
          span.textContent = n.author;
          a.appendChild(h3);
          a.appendChild(span);
          grid.appendChild(a);
        });
      })
      .catch(function () {});
  }

  // Note creation.

  function initCreateForm() {
    var form   = document.getElementById('create-form');
    var result = document.getElementById('create-result');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var title   = form.querySelector('[name="title"]').value.trim();
      var content = form.querySelector('[name="content"]').value;

      if (!title || !content) {
        showResult(result, 'error', 'Title and content are required.');
        return;
      }

      fetch(DEFAULTS.apiBase + '/notes', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title: title, content: content })
      })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (data.success) {
            saveNoteId(data.id);
            showResult(result, 'success',
              'Note created! <a href="' + escapeHtml(data.url) + '">View note &rarr;</a>');
            form.reset();
            loadPrivateNotes();
          } else {
            showResult(result, 'error', data.error || 'Failed to create note.');
          }
        })
        .catch(function () {
          showResult(result, 'error', 'Network error.');
        });
    });
  }

  // Settings.

  function loadAccountPreferences() {
    var form = document.getElementById('settings-form');
    var meta = document.getElementById('settings-meta');

    return fetch(ACCOUNT_PREFERENCES_API)
      .then(function (r) { return r.json(); })
      .then(function (data) {
        if (!data || !data.preferences) return;

        if (form) {
          setFieldValue(form, 'theme', data.preferences.theme);
          setFieldValue(form, 'fontSize', data.preferences.fontSize);
          setFieldValue(form, 'language', data.preferences.language);
          setFieldValue(form, 'defaultLayout', data.preferences.defaultLayout);
        }

        if (meta) {
          var presetCount = data.stats && typeof data.stats.presetCount === 'number'
            ? data.stats.presetCount
            : 0;
          meta.textContent = presetCount
            ? presetCount + ' reader preset' + (presetCount === 1 ? '' : 's') + ' synced to this browser profile.'
            : 'Preferences are saved per browser profile. Reader presets sync here automatically.';
        }
      })
      .catch(function () {});
  }

  function initSettingsForm() {
    var form   = document.getElementById('settings-form');
    var result = document.getElementById('settings-result');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var payload = {};
      new FormData(form).forEach(function (v, k) {
        payload[k] = isNaN(v) ? v : Number(v);
      });

      fetch(ACCOUNT_PREFERENCES_API, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (data.success) {
            if (data.preferences && typeof data.preferences.theme === 'string') {
              APP.theme = data.preferences.theme;
              applyTheme();
            }
            loadAccountPreferences();
            showResult(result, 'success', 'Settings saved.');
          } else {
            showResult(result, 'error', data.error || 'Failed.');
          }
        })
        .catch(function () {
          showResult(result, 'error', 'Network error.');
        });
    });
  }

  // Review request.

  function initReportButton() {
    var btn    = document.getElementById('report-btn');
    var result = document.getElementById('report-result');
    if (!btn) return;

    btn.addEventListener('click', function () {
      btn.disabled = true;
      var url = location.pathname + location.search + location.hash;

      fetch(DEFAULTS.apiBase + '/report', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ url: url })
      })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          showResult(result, data.success || data.message ? 'success' : 'error',
            data.message || data.error);
          setTimeout(function () { btn.disabled = false; }, 10000);
        })
        .catch(function () {
          showResult(result, 'error', 'Network error.');
          btn.disabled = false;
        });
    });
  }

  // Theme.

  function applyTheme() {
    document.documentElement.setAttribute('data-theme', APP.theme || 'dark');
  }

  // Utilities.

  function setFieldValue(form, name, value) {
    var field = form.querySelector('[name="' + name + '"]');
    if (!field || value == null) return;
    field.value = value;
  }

  function escapeHtml(str) {
    var d = document.createElement('div');
    d.textContent = str;
    return d.innerHTML;
  }

  function showResult(el, type, msg) {
    if (!el) return;
    el.className = 'result-msg result-' + type;
    el.innerHTML = msg;
    el.style.display = 'block';
    setTimeout(function () { el.style.display = 'none'; }, 8000);
  }

  // Init.

  document.addEventListener('DOMContentLoaded', async function () {
    await loadPanelManifest();
    applyTheme();
    initContentEnhancements();
    renderNoteContent();
    initSearch();
    initCreateForm();
    initSettingsForm();
    initReportButton();
    loadPrivateNotes();
    loadAccountPreferences();
  });
})();
