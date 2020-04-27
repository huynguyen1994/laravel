<!doctype html>
<html amp>

  <head>
   <meta charset="utf-8">
   <link rel="canonical" href="{{ url('login-amp')}}">
   <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
   <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
   <script async src="https://cdn.ampproject.org/v0.js"></script>
   
<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
<script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>

<script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
<script async custom-element="amp-selector" src="https://cdn.ampproject.org/v0/amp-selector-0.1.js"></script>
<script async custom-element="amp-bind" src="https://cdn.ampproject.org/v0/amp-bind-0.1.js"></script>
  
   <script async custom-element="amp-access" src="https://cdn.ampproject.org/v0/amp-access-0.1.js"></script> 
 <script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>

 <script async custom-element="amp-script" src="https://cdn.ampproject.org/v0/amp-script-0.1.js"></script>
  

  <script async src="https://cdn.ampproject.org/shadow-v0.js"></script>

      <style amp-custom>
/*#header {
      height: 24px;
      padding: 16px;
      margin: 0;
      text-align: center;
      text-transform: uppercase; /*  thiết lập các ký tự viết hoa cho văn bản.*/
      letter-spacing: 2px; /*  tăng hoặc giảm khoảng cách giữa các ký tự trong đoạn text. */
      line-height: 24px;
    }
    .menu {
      float: left;
    }
    .search {
      float: right;
    }
    #container {
      max-width: 500px;
      padding: 32px 16px 64px 16px;
      margin: auto;
    }
    .title {
      text-align: center;
    }
    .rating {
      margin-bottom: 0;
      text-align: center;
    }
    #carousel {
      margin: 16px;
    }
    .dots {
      text-align: center;
    }
    .dots span {
      display: inline-block;
      background: #ccc;
      border-radius: 6px;
      width: 12px;
      height: 12px;
      margin: 4px;
    }
    .dots span.current {
      background: #555;
    }
    .options {
      margin: 16px 0;
    }
    .options h6 {
      text-transform: uppercase;
      margin: 0 0 4px 0;
    }
    .colors table {
      margin: 0 -8px;
    }
    .colors amp-img {
      border: solid 2px white;
      display: block;
      margin: auto;
    }
    .colors amp-img[selected] {
      outline: solid 2px red;
    }
    .sizes div {
      border: solid 1px black;
      width: 40px;
      height: 40px;
      line-height: 40px;
      font-weight: 800;
      text-align: center;
    }
    .sizes div[selected] {
      background-color: gray;
      color: white;
      outline: none;
    }
    .unavailable::before {
      content: '';
      position: absolute;
      border-top: 1px solid black;
      margin-left: 1px;
      width: 57px;
      transform: rotate(45deg);
      transform-origin: 0% 0%;
    }
    .quantity select {
      font-size: 16px;
      border: solid 1px gray;
      padding: 8px;
    }
    table {
      width: 100%;
    }
    .hidden {
      display: none;
    }    


    :root {
      --color-primary: #005AF0;
      --color-secondary: #00DCC0;

      --space-1: .5rem;  /* 8px */
      --space-2: 1rem;   /* 16px */
      --space-3: 1.5rem; /* 24px */
      --space-5: 4rem; /* 64px */

      --box-shadow-1: 0 1px 1px 0 rgba(0,0,0,.14), 0 1px 1px -1px rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12);
    }*/


      body {
        line-height: 2rem;
        font-size: 1rem;
        font-family: Roboto, Arial, sans-serif;
        color: #222;
      }

      main {
        padding: 56px 0;
        margin: 10px;
        max-width: 750px;
      }

      p {
        margin-bottom: 2.5rem;
        font-size: 1.25rem;
      }

      input {
        height: 1.25rem;
        font-size: .875rem;
        margin-left: .25rem;
        padding: 0 .25rem;
        color: #222;
      }

      button {
        background-color: #005af0;
        color: #eee;
        font-size: 1rem;
        margin-top: 1rem;
        padding: .5rem 1rem;
        border-radius: 6px;
      }

      button:disabled {
        background-color: #ccc;
        color: #666;
      }

      main h2 {
        max-width: 600px;
        margin-left: .5rem;
        margin-right: .5rem;
      }

      .top {
        top: 0;
      }

      .nav-bar h1 {
        margin: 0;
        text-align: center;
      }

      .nav-bar {
        background: #005af0;
        box-shadow: 0 2px 10px 0 rgba(0,0,0,.07);
        color: #ffffff;
        height: 56px;
        line-height: 56px;
        overflow: hidden;
        position: fixed;
        width: 100%;
        z-index: 1000;
      }

      .card {
        background: #dee6ef;
        padding: 1rem;
        margin: .5rem;
        border-radius: 8px;
      }

      .form-input {
        margin-bottom: .5rem;
      }

      label {
        display: inline-block;
        width: 5rem;
      }

      #rules {
        line-height: 1.5rem;
        margin-top: 1.25rem;
        padding-left: .5rem;
        font-size: .875rem;
      }

      li.valid {
  color: #2d7b1f;
} 

li.invalid {
  color:#c11136;
}
  </style>

  </head>
  <body>

     @yield('main_amp')
  </body>
</html>