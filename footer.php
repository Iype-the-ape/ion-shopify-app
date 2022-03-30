</main>
<script src="https://unpkg.com/@shopify/app-bridge@2"></script>
<script src="https://unpkg.com/@shopify/app-bridge-utils"></script>
<script src="https://unpkg.com/axios/dist/axios.js"></script>
<script>
  var AppBridge = window['app-bridge'];
  var AppBridgeUtil = window['app-bridge-utils'];
  var actions = window['app-bridge'].actions;
  var createApp = AppBridge.default;

  var TitleBar = actions.TitleBar;
  var Button = actions.Button;
  var Redirect = actions.Redirect;
  var Modal = actions.Modal;

  var app = createApp({
      apiKey: '62d8ceee53febd72a3261af9860debcc',
      shopOrigin: '<?php echo $shopify->get_url(); ?>'
  });

  const modalOpt = {
      title: 'Test Modal',
      message: 'This is the content inside of the modal'
  };

  const testModal = Modal.create(app, modalOpt);

  const redirect = Redirect.create(app);
  var installScriptBtn = Button.create(app, { label: 'Add Script Tag' });
  var modalTestBtn = Button.create(app, { label: 'Open Modal' });

  installScriptBtn.subscribe(Button.Action.CLICK, data => {
    redirect.dispatch(Redirect.Action.APP,'/ion/script_tags.php');
  });

  modalTestBtn.subscribe(Button.Action.CLICK, data => {
    testModal.dispatch(Modal.Action.OPEN);
  });

  

  const titleBarOpt = {
      title: 'App',
      buttons: {
        secondary: [modalTestBtn,installScriptBtn]
      }
  }
  const appTitleBar = TitleBar.create(app, titleBarOpt);

  //============================================
  //        GETTING SESSION TOKEN
  //============================================

//   const getSessionToken = AppBridgeUtil.getSessionToken;

//   getSessionToken(app).then(token => {
//     var formData = new FormData();
//     formData.append('token', token);

//     fetch('verify_session.php', {
//       method: 'POST',
//       header: {
//         'Content-Type': 'application/json'
//       },
//       body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//       console.log(data);

//       if(data.success) {
//         axios({
//           method: 'POST',
//           url: 'authenticatedFetch.php',
//           data: {
//             shop: data.shop.host,
//             query: `query {
//                       products(first: 2) {
//                         edges {
//                           node {
//                             id
//                             title
//                             description
//                             images(first: 1) {
//                               edges {
//                                 node {
//                                   originalSrc
//                                 }
//                               }
//                             }
//                             status
//                           }
//                         }
//                       }
//                     }
// `
//           },
//           headers: {
//             'Content-Type': 'application/json',
//             'Authorization': 'Bearer: ' + token
//           }
//         }).then((response) => {
//           //console.log(response.data);
//         })
//       }
//     });
//   });
</script>
</body>
</html>