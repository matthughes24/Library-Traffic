<!DOCTYPE html>
<html>
   <head>
      <title>New Paltz Library Traffic</title>
   </head>

<body>
   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
   <script>
      let config = {
      headers: {'Content-Type': 'application/xml'}
      };
         const fetchCameraData = () => {
            axios.post("169.254.119.130/ISAPI/System/Video/inputs/channels/1/counting/search", xmlBodyStr, config)
            .then(res => {
            console.log(res);
            }).catch(err => console.log(err));
         }
         fetchCameraData();
         </script>
</body>

</html>