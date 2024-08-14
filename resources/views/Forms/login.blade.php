<div>
    <h1>LogIn Page</h1>

    <form action="/Login" method="post">
        @csrf
        <input type="email" name="email" placeholder="Enter your email"><br><br>
        <input type="password" name="password" placeholder="Enter password"><br><br>
        <button>Login</button>

    </form>
</div>



<style>
      body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          margin: 0;
          padding: 20px;
      }
      div {
          background: white;
          padding: 20px;
          border-radius: 8px;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          max-width: 400px;
          margin: auto;
      }
      h1 {
          text-align: center;
          color: #333;
      }
      
      input[type="email"],
      input[type="password"] {
          width: 100%;
          padding: 10px;
          margin: 8px 0;
          border: 1px solid #ccc;
          border-radius: 4px;
      }
      button {
          background-color: #28a745;
          color: white;
          padding: 10px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          width: 100%;
      }
      button:hover {
          background-color: #218838;
      }
  </style>