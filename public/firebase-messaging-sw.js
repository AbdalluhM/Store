/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
        apiKey: "AIzaSyD4Ex2SIrvAEG9wB68E3CqLiw6Xx76zwnE",
        authDomain: "e-commerce-36fb5.firebaseapp.com",
        databaseURL: "https://XXXX.firebaseio.com",
        projectId: "e-commerce-36fb5",
        storageBucket: "e-commerce-36fb5.appspot.com",
        messagingSenderId: "1022971678466",
        appId: "1:1022971678466:web:cd573218a85bd481f63c1b",
        measurementId: "G-BJ10QFNQK2"
    });

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
