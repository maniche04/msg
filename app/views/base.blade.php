<!doctype html>
<html lang="en">
  <head>
    <script>
      
      function notifyPerms() {
      // Let's check if the browser supports notifications
      
      if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
      }

      // Let's check if the user is okay to get some notification
      else if (Notification.permission === "granted") {
        // If it's okay let's create a notification
        notifyMe("Hi! The notification system is now running, and you'll be receiving your messages here. Please do not close your browser window!",'https://cdn2.iconfinder.com/data/icons/office-general-2/64/new_message-128.png');

        var thebutton = document.getElementById('permission');
        thebutton.style.display = 'none';
      }

      // Otherwise, we need to ask the user for permission
      // Note, Chrome does not implement the permission static property
      // So we have to check for NOT 'denied' instead of 'default'
      else if (Notification.permission !== 'denied') {
        
        Notification.requestPermission(function (permission) {

          // Whatever the user answers, we make sure we store the information
          if(!('permission' in Notification)) {
            Notification.permission = permission;
          }

          // If the user is okay, let's create a notification
          if (permission === "granted") {
            
            notifyMe("Hi! The notification system is now running, and you'll be receiving your messages here. Please do not close your browser window!",'http://png-3.findicons.com/files/icons/1035/human_o2/48/gnome_fs_executable.png');

            var thebutton = document.getElementById('permission');
        thebutton.style.display = 'none';

          }
        });
      }

      // At last, if the user already denied any notification, and you 
      // want to be respectful there is no need to bother him any more.
    };

    function notifyMe(text, bodytext, icontext) {
      // Let's check if the browser supports notifications
      var opttext = {body: bodytext,icon: icontext};

      if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
      }

      // Let's check if the user is okay to get some notification
      else if (Notification.permission === "granted") {
        // If it's okay let's create a notification
        var notification = new Notification(text, opttext);
        
        
      }

      // Otherwise, we need to ask the user for permission
      // Note, Chrome does not implement the permission static property
      // So we have to check for NOT 'denied' instead of 'default'
      else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {

          // Whatever the user answers, we make sure we store the information
          if(!('permission' in Notification)) {
            Notification.permission = permission;
          }

          // If the user is okay, let's create a notification
          if (permission === "granted") {
            var notification = new Notification(text, opttext);
          }
        });
      }

      // At last, if the user already denied any notification, and you 
      // want to be respectful there is no need to bother him any more.
    };

    if (!!window.EventSource) {
      var source = new EventSource('msg/get');
    } else {
      // Result to xhr polling :(
    }

    source.addEventListener('message', function(e) {
      var data = JSON.parse(e.data);
      if (data.msg == 'none') {
        //do nothing
      } else {
        if (data.from == 'system') {
          var title = 'System notification....';
          notifyMe(title,data.msg,'http://www.iconarchive.com/download/i43008/oxygen-icons.org/oxygen/Apps-system-software-update.ico');
        } else {

          var title = data.from + ' says....';
          notifyMe(title,data.msg,'http://png-3.findicons.com/files/icons/1035/human_o2/48/gnome_fs_executable.png');
        }
        
      };
      
    }, false);

    </script>

    @section('addhead')

    This is the additional header section

    @show

  </head>

  <body>

    @section('body')

    This is the body

    @show

  </body>

</html>