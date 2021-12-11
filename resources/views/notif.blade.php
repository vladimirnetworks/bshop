<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>Change_me</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
</head>

<body>
  
<div class="container">
  <header>
    <h1>Push Codelab</h1>
  </header>

  <main>
    <p>Welcome to the push messaging codelab. The button below needs to be
    fixed to support subscribing to push.</p>
    <p>
      <button disabled class="js-push-btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
        Enable Push Messaging
      </button>
    </p>
    <section class="subscription-details js-subscription-details is-invisible">
      <p>Once you've subscribed your user, you'd send their subscription to your
      server to store in a database so that when you want to send a message
      you can lookup the subscription and send a message to it.</p>
      <p>To simplify things for this code lab copy the following details
      into the <a href="https://web-push-codelab.glitch.me//">Push Companion
      Site</a> and it'll send a push message for you, using the application
      server keys on the site - so make sure they match.</p>
      <pre><code class="js-subscription-json"></code></pre>
    </section>
  </main>
</div>

<script>
'use strict';

const applicationServerPublicKey = 'BPzpEiZerN0INBDvqd8cgUaXvn6_UVt8F0A1eLDb18YkpFno6YvIsZFreSOtW5Izq_CN23yBgdz7UFc7FxlzKFY';

const pushButton = document.querySelector('.js-push-btn');

let isSubscribed = false;
let swRegistration = null;

function urlB64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('Service Worker and Push is supported');
  navigator.serviceWorker.register('sw.js')
  .then(function(swReg) {
    console.log('Service Worker is registered', swReg);
    swRegistration = swReg;
  })
  .catch(function(error) {
    console.error('Service Worker Error', error);
  });
} else {
  console.warn('Push messaging is not supported');
  pushButton.textContent = 'Push Not Supported';
}





function updateBtn() {
  if (isSubscribed) {
    pushButton.textContent = 'Disable Push Messaging';
  } else {
    pushButton.textContent = 'Enable Push Messaging';
  }
  pushButton.disabled = false;
}



function initializeUI() {
  // Set the initial subscription value
  swRegistration.pushManager.getSubscription()
  .then(function(subscription) {
    isSubscribed = !(subscription === null);
    if (isSubscribed) {
      console.log('User IS subscribed.');
    } else {
      console.log('User is NOT subscribed.');
    }
    updateBtn();
  });
}



</script>

</body>
</html>