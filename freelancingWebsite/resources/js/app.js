import { Toast } from 'bootstrap';
import Echo from 'laravel-echo';
import './bootstrap';


//window._ = require('lodash');
//window.$ = window.jQuery = require('jquery');
//require('bootstrap-sass');
/*
var notifications = [];

const NOTIFICATION_TYPES = {
    createProposal: 'App\\Notifications\\CreateProposal'
};


$(document).ready(function() {
    // check if there's a logged in user
    if (Laravel.userId) {
        $.get('/notifications', function(data) {
            addNotifications(data, "#notifications");
        });
    }
});

function showNotifications(notifications, target) {
    if (notifications.length) {
        var htmlElements = notifications.map(function(notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
        $(target).removeClass('has-notifications');
    }
}


function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}


// Make a single notification string
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '<li><a href="' + to + '">' + notificationText + '</a></li>';
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if (notification.type === NOTIFICATION_TYPES.follow) {
        to = 'users' + to;
    }
    return '/' + to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if (notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        text += '<strong>' + name + '</strong> followed you';
    }
    return text;
}
*/
let userId = 1;

// window.Echo.private('App.Models.User.' + userId).notification(function() {
//     alert(notification.msg)

// });

window.Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
        toastr.success('<a href="' +
            notification.link + '"> click here</a>',
            notification.title, '<i class="' + notification.icon + '"></i>')
        alert(notification.title)

    });