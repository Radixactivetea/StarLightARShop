import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { MindARThree } from 'mindar-image-three';


document.addEventListener("DOMContentLoaded", () => {
    const start = async () => {

        const mindarThree = new MindARThree({
            container: document.body,
            imageTargetSrc: '../targest/targets.mind',
            //for many tracking at same times
            // maxTrack: 2,
        });
        const { renderer, scene, camera } = mindarThree;

        const light = new THREE.HemisphereLight(0xffffff, 0xbbbbff, 1);
        scene.add(light);

        const raccoonAnchor = mindarThree.addAnchor(0);

        const loader = new GLTFLoader();
        loader.load('../models/cup.glb', (raccoon) => {
            raccoonAnchor.group.add(raccoon.scene);
            raccoon.scene.scale.set(1, 1, 1);
            raccoon.scene.position.set(0, -0.4, 0);
        });

        await mindarThree.start();
        renderer.setAnimationLoop(() => {
            renderer.render(scene, camera);
        });
    }
    start();
});