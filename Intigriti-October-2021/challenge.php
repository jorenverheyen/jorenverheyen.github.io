
<html lang="en">
  <head>
    <title>BOOOOOOO!</title>
    <meta
      http-equiv="Content-Security-Policy"
      content="default-src 'none'; script-src 'unsafe-eval' 'strict-dynamic' 'nonce-bf42997ca936c3609c7370368e892767'; style-src 'nonce-c7800bb180f577dccf4e4d6ec38451af'"
    />

    <style nonce="c7800bb180f577dccf4e4d6ec38451af">
      .a {
        display: none;
      }

      #html {
          text-align: center;
      }

      /* :::::::::::::: Presentation css */
      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          --locked-color: #5fadbf;
          --unlocked-color: #ff5153;
          font-family: "Courier New", sans-serif;
      }
      .container {
          -webkit-user-select: none;  /* Chrome all / Safari all */
          -moz-user-select: none;     /* Firefox all */
          -ms-user-select: none;      /* IE 10+ */
          user-select: none;
          display: flex;
          align-items: center;
          justify-content: center;
          min-height: 100px;
          padding-top: 50px;
      }

      :root {
          --basecolor: hsl(20, 70%, 40%);
      }

      body {
          background: #222;
          text-align: center;
      }

      /* Layout and font */
      .wrapper {
          width: 700px;
          position: relative;
          margin: auto;
      }

      .bat-overlay,
      .text {
          width: 100%;
          height: 100%;
          position: absolute;
          top: 0;
          left: 0;
      }

      h1 {
          text-align: center;
          color: var(--basecolor);
          line-height: 0.8em;
          font-size: 10vw;
          margin: 1em 0em 0.5em 0em;
          font-family: "Baloo Chettan 2", arial;
      }

      .dark {
          color: #000;
          transition: 0.5s;
          transition-timing-function: ease-in-out;
          opacity: 0.5;
      }

      .light {
          margin-left: 5%;
          margin-right: 15%;
          transition: 0.5s;
          transition-timing-function: ease-in-out;
      }

      .bat-overlay {
          z-index: 10;
          pointer-events: none;
      }

      /* Dropdown*/

      #monster-select {
          background: rgba(0, 0, 0, 0.3);
          border: none;
          padding: 10px;
          color: var(--basecolor);
          border-radius: 10px;
          font-size: 0.9em;
          font-family: "Baloo Chettan 2", arial;
          text-align: center;
      }

      .dropdown {
          font-size: 1em;
          color: var(--basecolor);
      }

      .close {
          transition: 1s;
          opacity: 0;
      }

      select {
          outline: none;
          -webkit-appearance: none;
      }
      select:-moz-focusring {
          color: transparent;
          text-shadow: 0 0 0 #000;
      }

      /* Bats*/
      svg {
          width: 100%;
      }

      .eye {
          fill: var(--basecolor);
      }

      .shadow {
          -webkit-filter: blur(6px);
          filter: blur(6px);
          opacity: 0.2;
      }

      .bat {
          animation-direction: normal;
          animation: move 15s infinite;
          animation-timing-function: ease-in-out;
          transform-origin: 50% 50%;
      }

      .bat1 {
          animation-direction: normal;
          animation: move1 15s infinite;
          animation-timing-function: ease-in-out;
          transform-origin: 50% 50%;
      }

      .bat2 {
          animation-direction: normal;
          animation: move2 15s infinite;
          animation-timing-function: ease-in-out;
          transform-origin: 50% 50%;
      }

      .wing {
          transform-origin: 50% 50%;
          animation-direction: normal;
          animation: wing 1s infinite;
          animation-timing-function: ease-in-out;
      }

      .wing1 {
          transform-origin: 50% 50%;
          animation-direction: normal;
          animation: wing1 1s infinite;
          animation-timing-function: ease-in-out;
      }

      @keyframes move {
          0% {
              transform: translate(150px, 90px) rotate(10deg);
          }
          25% {
              transform: translate(-150px, 90px) rotate(-10deg);
          }
          50% {
              transform: translate(-160px, -80px) rotate(10deg);
          }
          75% {
              transform: translate(-140px, -100px) rotate(-10deg);
          }

          100% {
              transform: translate(150px, 90px) rotate(10deg);
          }
      }

      @keyframes move1 {
          0% {
              transform: translate(-140px, -70px) rotate(-10deg);
          }
          25% {
              transform: translate(0px, -50px) rotate(10deg);
          }
          50% {
              transform: translate(150px, 50px) rotate(-10deg);
          }
          75% {
              transform: translate(-100px, 30px) rotate(10deg);
          }
          85% {
              transform: translate(-110px, 90px) rotate(10deg);
          }

          100% {
              transform: translate(-140px, -70px) rotate(-10deg);
          }
      }

      @keyframes move2 {
          0% {
              transform: translate(150px, -70px) scale(1) rotate(10deg);
          }
          25% {
              transform: translate(160px, -90px) scale(0.7) rotate(-10deg);
          }
          50% {
              transform: translate(170px, -100px) scale(0.7) rotate(10deg);
          }
          75% {
              transform: translate(105px, -80px) scale(1) rotate(-10deg);
          }

          100% {
              transform: translate(150px, -70px) scale(1) rotate(10deg);
          }
      }

      @keyframes wing {
          0% {
              transform: translate(0px, 0px) scale(1) rotate(0deg);
          }
          50% {
              transform: translate(0px, 0px) scaleX(0.5) rotate(-25deg);
          }
          100% {
              transform: translate(0px, 0px) scale(1) rotate(0deg);
          }
      }

      @keyframes wing1 {
          0% {
              transform: translate(0px, 0px) scale(1) rotate(0deg);
          }
          50% {
              transform: translate(0px, 0px) scaleX(0.5) rotate(25deg);
          }
          100% {
              transform: translate(0px, 0px) scale(1) rotate(0deg);
          }
      }

      /* Mobile*/
      @media screen and (max-width: 600px) {
          .wrapper {
              width: 100% !important;
          }
          h1 {
              font-size: 2em;
          }
      }
      :root {
          font-size: 16px;
          font-family: codystar;
          font-weight: bold;
          --light-color: var(--basecolor);
          --dark-color: #222;
      }

      @keyframes box_flicker {
          0%,
          3%,
          4%,
          5%,
          10%,
          15%,
          20%,
          27%,
          29%,
          33%,
          39%,
          50%,
          65%,
          70%,
          75%,
          77%,
          90%,
          93%,
          97%,
          100% {
              box-shadow: 0px 0px 5px 3px var(--light-color),
              0px 0px 5px 3px var(--light-color) inset;
          }
          1%,
          2%,
          25%,
          30%,
          35%,
          40%,
          45%,
          49%,
          57%,
          59%,
          64%,
          67%,
          73%,
          80%,
          85%,
          95% {
              box-shadow: 0px 0px 5px 4px var(--light-color),
              0px 0px 5px 4px var(--light-color) inset;
          }
      }

      @keyframes text_flicker {
          0%,
          3%,
          4%,
          5%,
          10%,
          15%,
          20%,
          27%,
          29%,
          33%,
          39%,
          50%,
          65%,
          70%,
          75%,
          77%,
          90%,
          93%,
          97%,
          100% {
              text-shadow: 1px 1px 6px var(--light-color), 0 0 1rem var(--light-color),
              0 0 0.2em var(--light-color);
          }
          1%,
          2%,
          25%,
          30%,
          35%,
          40%,
          45%,
          80%,
          85%,
          95% {
              text-shadow: 1px 1px 8px var(--light-color), 0 0 1rem var(--light-color),
              0 0 0.2em var(--light-color);
          }
      }

      @keyframes extra_flicker {
          0%,
          3%,
          4%,
          5%,
          10%,
          15%,
          20%,
          27%,
          29%,
          33%,
          39%,
          50%,
          65%,
          70%,
          75%,
          77%,
          90%,
          93%,
          97%,
          100% {
              text-shadow: 1px 1px 6px var(--dark-color), 0 0 1rem var(--dark-color),
              0 0 0.2em var(--dark-color);
          }
          1%,
          2%,
          25%,
          30%,
          35%,
          40%,
          45%,
          80%,
          85%,
          95% {
              text-shadow: 1px 1px 8px var(--light-color), 0 0 1rem var(--light-color),
              0 0 0.2em var(--light-color);
          }
      }

      body {
          display: flex;
          justify-content: center;
      }

      #container {
          display: flex;
          flex-direction: column;
          font-size: 2rem;
          padding: 2rem;
          border: 0.2rem solid var(--basecolor);
          border-radius: 1rem;
          color: var(--light-color);
          margin: 2rem;
          animation: box_flicker 0.5s infinite;
      }

      span {
          animation: text_flicker 0.5s infinite;
          user-select: none;
      }

      span#y {
          text-shadow: 1px 1px 9px var(--light-color), 0 0 0.5rem var(--light-color),
          0 0 0.1em var(--light-color);
      }

      span#extra-flicker {
          animation: extra_flicker 0.5s infinite;
      }

      #broken {
          display: inline-block;
          transform: rotate(-10deg);
          transform-origin: top right;
          transition: transform 0.4s ease-in-out;
          cursor: pointer;
          user-select: none;
      }

      #broken:hover,
      #broken:active {
          transform: rotate(0deg);
      }


    </style>
  </head>
  <body id="body">
  <div class="wrapper"">
  <div class=" bat-overlay">

      <!-- Bats -->
      <svg version="1.1" id="Lager_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 600 400" style="enable-background:new 0 0 600 400;" xml:space="preserve">

		<g class="bat">
            <path d="M306.9,145.4l-7.3,7.3l-7.3-7.3c-0.6-0.6-1.6-0.2-1.6,0.6v7.9h7.6h2.5h7.6V146C308.5,145.2,307.5,144.8,306.9,145.4z" />
            <path class="wing" d="M408.4,167.5c-3.3-2.7-7.6-4.4-12.2-4.4c-9.3,0-17.1,6.6-18.9,15.4c-2.8-1.6-6.1-2.5-9.6-2.5c-8.5,0-15.7,5.5-18.3,13.1
		c-3-6.6-9.7-11.3-17.5-11.3c-7.7,0-14.4,4.6-17.5,11.1c-6.9-4.7-11-10.7-11-17.1c0-2.4,0.6-4.7,1.6-6.9c0.2,0,0.4,0,0.7,0
		c24.7,0,45.4-9,51.2-21.1C383,144.1,404.5,154.3,408.4,167.5z" />

            <path class="wing1" d="M191.6,167.5c3.3-2.7,7.6-4.4,12.2-4.4c9.3,0,17.1,6.6,18.9,15.4c2.8-1.6,6.1-2.5,9.6-2.5c8.5,0,15.7,5.5,18.3,13.1
		c3-6.6,9.7-11.3,17.5-11.3c7.7,0,14.4,4.6,17.5,11.1c6.9-4.7,11-10.7,11-17.1c0-2.4-0.6-4.7-1.6-6.9c-0.2,0-0.4,0-0.7,0
		c-24.7,0-45.4-9-51.2-21.1C217,144.1,195.5,154.3,191.6,167.5z" />
            <path d="M312.3,158.2c0,5.2-6,27.3-12.9,27.3c-7,0-12.3-22.1-12.3-27.3s5.7-9.5,12.6-9.5C306.6,148.8,312.3,153,312.3,158.2z" />

            <ellipse class="eye" cx="295.2" cy="161.8" rx="1.5" ry="3" />
            <ellipse class="eye" cx="304.2" cy="161.8" rx="1.5" ry="3" />

            <g class="shadow">
                <path class="wing" d="M387.8,238.6c-2.7-2.2-6.1-3.5-9.9-3.5c-7.5,0-13.8,5.4-15.3,12.5c-2.3-1.3-4.9-2.1-7.8-2.1c-6.9,0-12.7,4.4-14.8,10.6
		c-2.5-5.4-7.9-9.1-14.2-9.1c-6.3,0-11.7,3.7-14.1,9c-5.6-3.8-8.9-8.6-8.9-13.8c0-1.9,0.5-3.8,1.3-5.6c0.2,0,0.4,0,0.6,0
		c20,0,36.7-7.3,41.4-17.1C367.3,219.6,384.7,227.8,387.8,238.6z" />
                <path class="wing1" d="M212.2,238.6c2.7-2.2,6.1-3.5,9.9-3.5c7.5,0,13.8,5.4,15.3,12.5c2.3-1.3,4.9-2.1,7.8-2.1c6.9,0,12.7,4.4,14.8,10.6
		c2.5-5.4,7.9-9.1,14.2-9.1c6.3,0,11.7,3.7,14.1,9c5.6-3.8,8.9-8.6,8.9-13.8c0-1.9-0.5-3.8-1.3-5.6c-0.2,0-0.4,0-0.6,0
		c-20,0-36.7-7.3-41.4-17.1C232.7,219.6,215.3,227.8,212.2,238.6z" />
                <ellipse cx="299" cy="242.2" rx="9.3" ry="17" />
            </g>
        </g>

          <g class="bat1">
              <path d="M306.9,145.4l-7.3,7.3l-7.3-7.3c-0.6-0.6-1.6-0.2-1.6,0.6v7.9h7.6h2.5h7.6V146C308.5,145.2,307.5,144.8,306.9,145.4z" />
              <path class="wing" d="M408.4,167.5c-3.3-2.7-7.6-4.4-12.2-4.4c-9.3,0-17.1,6.6-18.9,15.4c-2.8-1.6-6.1-2.5-9.6-2.5c-8.5,0-15.7,5.5-18.3,13.1
		c-3-6.6-9.7-11.3-17.5-11.3c-7.7,0-14.4,4.6-17.5,11.1c-6.9-4.7-11-10.7-11-17.1c0-2.4,0.6-4.7,1.6-6.9c0.2,0,0.4,0,0.7,0
		c24.7,0,45.4-9,51.2-21.1C383,144.1,404.5,154.3,408.4,167.5z" />

              <path class="wing1" d="M191.6,167.5c3.3-2.7,7.6-4.4,12.2-4.4c9.3,0,17.1,6.6,18.9,15.4c2.8-1.6,6.1-2.5,9.6-2.5c8.5,0,15.7,5.5,18.3,13.1
		c3-6.6,9.7-11.3,17.5-11.3c7.7,0,14.4,4.6,17.5,11.1c6.9-4.7,11-10.7,11-17.1c0-2.4-0.6-4.7-1.6-6.9c-0.2,0-0.4,0-0.7,0
		c-24.7,0-45.4-9-51.2-21.1C217,144.1,195.5,154.3,191.6,167.5z" />
              <path d="M312.3,158.2c0,5.2-6,27.3-12.9,27.3c-7,0-12.3-22.1-12.3-27.3s5.7-9.5,12.6-9.5C306.6,148.8,312.3,153,312.3,158.2z" />

              <ellipse class="eye" cx="295.2" cy="161.8" rx="1.5" ry="3" />
              <ellipse class="eye" cx="304.2" cy="161.8" rx="1.5" ry="3" />

              <g class="shadow">
                  <path class="wing" d="M387.8,238.6c-2.7-2.2-6.1-3.5-9.9-3.5c-7.5,0-13.8,5.4-15.3,12.5c-2.3-1.3-4.9-2.1-7.8-2.1c-6.9,0-12.7,4.4-14.8,10.6
		c-2.5-5.4-7.9-9.1-14.2-9.1c-6.3,0-11.7,3.7-14.1,9c-5.6-3.8-8.9-8.6-8.9-13.8c0-1.9,0.5-3.8,1.3-5.6c0.2,0,0.4,0,0.6,0
		c20,0,36.7-7.3,41.4-17.1C367.3,219.6,384.7,227.8,387.8,238.6z" />
                  <path class="wing1" d="M212.2,238.6c2.7-2.2,6.1-3.5,9.9-3.5c7.5,0,13.8,5.4,15.3,12.5c2.3-1.3,4.9-2.1,7.8-2.1c6.9,0,12.7,4.4,14.8,10.6
		c2.5-5.4,7.9-9.1,14.2-9.1c6.3,0,11.7,3.7,14.1,9c5.6-3.8,8.9-8.6,8.9-13.8c0-1.9-0.5-3.8-1.3-5.6c-0.2,0-0.4,0-0.6,0
		c-20,0-36.7-7.3-41.4-17.1C232.7,219.6,215.3,227.8,212.2,238.6z" />
                  <ellipse cx="299" cy="242.2" rx="9.3" ry="17" />
              </g>
          </g>

          <g class="bat2">
              <path d="M306.9,145.4l-7.3,7.3l-7.3-7.3c-0.6-0.6-1.6-0.2-1.6,0.6v7.9h7.6h2.5h7.6V146C308.5,145.2,307.5,144.8,306.9,145.4z" />
              <path class="wing" d="M408.4,167.5c-3.3-2.7-7.6-4.4-12.2-4.4c-9.3,0-17.1,6.6-18.9,15.4c-2.8-1.6-6.1-2.5-9.6-2.5c-8.5,0-15.7,5.5-18.3,13.1
		c-3-6.6-9.7-11.3-17.5-11.3c-7.7,0-14.4,4.6-17.5,11.1c-6.9-4.7-11-10.7-11-17.1c0-2.4,0.6-4.7,1.6-6.9c0.2,0,0.4,0,0.7,0
		c24.7,0,45.4-9,51.2-21.1C383,144.1,404.5,154.3,408.4,167.5z" />

              <path class="wing1" d="M191.6,167.5c3.3-2.7,7.6-4.4,12.2-4.4c9.3,0,17.1,6.6,18.9,15.4c2.8-1.6,6.1-2.5,9.6-2.5c8.5,0,15.7,5.5,18.3,13.1
		c3-6.6,9.7-11.3,17.5-11.3c7.7,0,14.4,4.6,17.5,11.1c6.9-4.7,11-10.7,11-17.1c0-2.4-0.6-4.7-1.6-6.9c-0.2,0-0.4,0-0.7,0
		c-24.7,0-45.4-9-51.2-21.1C217,144.1,195.5,154.3,191.6,167.5z" />
              <path d="M312.3,158.2c0,5.2-6,27.3-12.9,27.3c-7,0-12.3-22.1-12.3-27.3s5.7-9.5,12.6-9.5C306.6,148.8,312.3,153,312.3,158.2z" />

              <ellipse class="eye" cx="295.2" cy="161.8" rx="1.5" ry="3" />
              <ellipse class="eye" cx="304.2" cy="161.8" rx="1.5" ry="3" />

              <g class="shadow">
                  <path class="wing" d="M387.8,238.6c-2.7-2.2-6.1-3.5-9.9-3.5c-7.5,0-13.8,5.4-15.3,12.5c-2.3-1.3-4.9-2.1-7.8-2.1c-6.9,0-12.7,4.4-14.8,10.6
		c-2.5-5.4-7.9-9.1-14.2-9.1c-6.3,0-11.7,3.7-14.1,9c-5.6-3.8-8.9-8.6-8.9-13.8c0-1.9,0.5-3.8,1.3-5.6c0.2,0,0.4,0,0.6,0
		c20,0,36.7-7.3,41.4-17.1C367.3,219.6,384.7,227.8,387.8,238.6z" />
                  <path class="wing1" d="M212.2,238.6c2.7-2.2,6.1-3.5,9.9-3.5c7.5,0,13.8,5.4,15.3,12.5c2.3-1.3,4.9-2.1,7.8-2.1c6.9,0,12.7,4.4,14.8,10.6
		c2.5-5.4,7.9-9.1,14.2-9.1c6.3,0,11.7,3.7,14.1,9c5.6-3.8,8.9-8.6,8.9-13.8c0-1.9-0.5-3.8-1.3-5.6c-0.2,0-0.4,0-0.6,0
		c-20,0-36.7-7.3-41.4-17.1C232.7,219.6,215.3,227.8,212.2,238.6z" />
                  <ellipse cx="299" cy="242.2" rx="9.3" ry="17" />
              </g>
          </g>

	</svg>

  </div>

      <script nonce="bf42997ca936c3609c7370368e892767">document.getElementById('lock').onclick = () => {document.getElementById('lock').classList.toggle('unlocked');}</script>
    <script nonce="bf42997ca936c3609c7370368e892767">
      window.addEventListener("DOMContentLoaded", function () {
        e = `)]}'` + new URL(location.href).searchParams.get("xss");
        c = document.getElementById("body").lastElementChild;
        if (c.id === "intigriti") {
          l = c.lastElementChild;
          i = l.innerHTML.trim();
          f = i.substr(i.length - 4);
          e = f + e;
        }
        let s = document.createElement("script");
        s.type = "text/javascript";
        s.appendChild(document.createTextNode(e));
        document.body.appendChild(s);
      });
    </script>
  </div>
    <!-- !!! -->
      <div id="html" class="text"><h1 class="light">HALLOWEEN HAS TAKEN OVER!</h1>ARE YOU SCARED?<br/>ARE YOU STILL SANE?<br/>NOBODY CAN BREAK THIS!<br/>NOBODY CAN SAVE INTIGRITI<br/>I USE ?html= TO CONVEY THESE MESSAGES<br/>I'LL RELEASE INTIGRITI FROM MY WRATH... <br/>... AFTER YOU POP AN XSS<br/>ELSE, INTIGRITI IS MINE!<br/>SIGNED* 1337Witch69</div>
    <!-- !!! -->
    <div class="a">'"</div>
  </body>
  <div id="container">
      <span>I</span>
      <span id="extra-flicker">N</span>
      <span>T</span>
      <span>I</span>
      <div id="broken">
          <span id="y">G</span>
      </div>
      <span>R</span>
      <div id="broken">
          <span id="y">I</span>
      </div>
      <span>T</span>
      <span>I</span>
  </div>
</html>
