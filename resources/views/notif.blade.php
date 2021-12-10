@extends('main')

@section('main')

<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries
  
    // Your web app's Firebase configuration
    const firebaseConfig = {
      apiKey: "AIzaSyCtdaK424sHk0HT8v023xtfnBaDeAYOfDk",
      authDomain: "behkiana-2eddb.firebaseapp.com",
      projectId: "behkiana-2eddb",
      storageBucket: "behkiana-2eddb.appspot.com",
      messagingSenderId: "643879886315",
      appId: "1:643879886315:web:a1534d29b50bd3389e8dae"
    };
  
    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
  </script>

@stop