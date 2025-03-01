<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Light Pottery Shop</title>
    <link rel="icon" href="/public/img/logo.png" type="image/x-icon">
    <!-- bootstap css & override -->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter&amp;display=swap">

    <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/donmccurdy/aframe-extras@v7.0.0/dist/aframe-extras.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.2.5/dist/mindar-image-aframe.prod.js"></script>

<body>
    <a-scene
        mindar-image="imageTargetSrc: ../public/targets.mind"
        color-space="sRGB" renderer="colorManagement: true, physicallyCorrectLights" vr-mode-ui="enabled: false"
        device-orientation-permission-ui="enabled: false">
        <a-assets>
            <a-asset-item id="cupModel"
                src="/public/models/cup.glb"></a-asset-item>
            <!-- <a-asset-item id="jugModel"
                src="/public/models/jug.glb"></a-asset-item>
                <a-asset-item id="potModel"
                src="/public/models/pot.glb"></a-asset-item> -->
        </a-assets>

        <a-camera position="0 0 0" look-controls="enabled: false"></a-camera>
        
        <!-- <a-entity mindar-image-target="targetIndex: 0">
            <a-gltf-model rotation="0 0 0 " position="0 0 0" scale="5 5 5" src="#jugModel"
                animation-mixer>
        </a-entity> -->
        <a-entity mindar-image-target="targetIndex: 0">
            <a-gltf-model rotation="0 0 0 " position="0 0 0" scale="5 5 5" src="#cupModel"
                animation-mixer>
        </a-entity>
        <!-- <a-entity mindar-image-target="targetIndex: 2">
            <a-gltf-model rotation="0 0 0 " position="0 0 0" scale="5 5 5" src="#potModel"
                animation-mixer>
        </a-entity> -->
    </a-scene>

    <!-- bootstap and popper -->
    <script src="/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>