<footer>
  <style>
    footer {
      background-color: #f5f5f5;
      padding: 20px 0;
      color: #333;
      text-align: center;
    }

    .col {
      display: inline-block;
      width: 50%;
      vertical-align: top;
    }

    .col h3 {
      margin-bottom: 10px;
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    li {
      margin-bottom: 5px;
    }

    a {
      color: #333;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #000;
    }

    p {
      margin-bottom: 0;
    }

    /* Přidejte další styly pro tlačítka */
    .btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    /* Animace pro tlačítka */
    .btn {
      position: relative;
      overflow: hidden;
    }

    .btn:after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 300%;
      height: 300%;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 50%;
      transition: width 0.3s ease, height 0.3s ease, opacity 0.3s ease;
      z-index: 0;
      transform: translate(-50%, -50%);
    }

    .btn:hover:after {
      width: 0;
      height: 0;
      opacity: 0;
    }

    /* Styly pro ikony */
    .fa {
      transition: transform 0.3s ease;
    }

    .fa:hover {
      transform: scale(1.2);
    }

    /* Animovaný proužek pro copyright text */
    .copyright {
      display: inline-block;
      position: relative;
      padding: 5px 20px;
      margin-top: 20px;
      background: linear-gradient(to right, rgba(255, 255, 255, 0), #f5f5f5, rgba(255, 255, 255, 0));
      animation: copyright-bg 2s infinite;
    }

    @keyframes copyright-bg {
      0% {
        background-position: 0 0;
      }
      100% {
        background-position: 200% 0;
      }
    }
  </style>

  <div class="col">
    <div class="copyright">&copy; 2024 Rezervační systém Mrázek</div>
  </div>
</footer>
  </body>