    <style>
      * {
      box-sizing: border-box;
      }
      body {
      font-family: Roboto, Helvetica, sans-serif;
      }
      /* Fix the button on the left side of the page */
      .open-btn {
      display: flex;
      justify-content: left;
      }
      /* Style and fix the button on the page */
      .open-button {
      background-color: #1c87c9;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      opacity: 0.8;
      position: fixed;
      }
      /* Position the Popup form */
      .login-popup-AD {
      position: relative;
      text-align: center;
      width: 100%;
      background-color: #fff;
      }
      /* Hide the Popup form */
      .form-popup-AD {
      display: none;
      position: fixed;
      left: 50%;
      top: 10%;
      transform: translate(-50%,10%);
      border: 2px solid #666;
      z-index: 9;
      background-color: #fff;
      }
      /* Styles for the form container */
      .form-container-AD {
      max-width: 500px;
      padding: 15px;
      background-color: #fff;
      }
      /* Full-width for input fields */
      .form-container-AD input[type=text], .form-container-AD input[type=password], .form-container-AD input[type=date], .form-container-AD input[type=time] {
      width: 250px;
      padding: 7px;
      margin: 5px 0 5px 0;
      border: none;
      background: #eee;
      }
      /* Select fields */
      .form-container-AD select {
      padding: 10px;
      margin: 5px 0 10px 0;
      border: none;
      background: #eee;
      }
      .form-container-AD textarea {
      width: 250px;
      height: 100px;
      padding: 10px;
      margin: 5px 0 10px 0;
      border: none;
      background: #eee;
      }
      /* When the inputs get focus, do something */
      .form-container-AD input[type=text]:focus, .form-container-AD input[type=password]:focus, .form-container-AD select:focus {
      background-color: #ddd;
      outline: none;
      }
      /* Style submit/login button */
      .form-container-AD .btn {
      background-color: #8ebf42;
      color: #fff;
      padding: 12px 20px;
      border: none;
      cursor: pointer;
      margin-bottom:10px;
      opacity: 0.8;
      }
      /* Style cancel button */
      .form-container-AD .cancel {
      background-color: #cc0000;
      }
      /* Hover effects for buttons */
      .form-container-AD .btn:hover, .open-button:hover {
      opacity: 1;
      }
    </style>
