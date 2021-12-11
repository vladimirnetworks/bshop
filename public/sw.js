self.addEventListener('push', function(event) {
    console.log('[Service Worker] Push Received.');
    console.log(`[Service Worker] Push had this data: "${event.data.text()}"`);
    const title = 'Push Codelab';
    const options = {
        body: 'Yay it works.',
        icon: '/icons/home.png',
        badge: '/icons/orders.png'
    };


    const notificationPromise = self.registration.showNotification(title, options);

    event.waitUntil(notificationPromise);
});