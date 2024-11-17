import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

document.addEventListener('DOMContentLoaded', () => {

    const initialize = async () => {

        //get button
        const arButton = document.querySelector("#ar-button");

        const supported = navigator.xr && await navigator.xr.isSessionSupported("immersive-ar")
        if (!supported) {
            arButton.textContent = "Not Supported";
            arButton.disabled = true;
            return;
        }

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera();
        const renderer = new THREE.WebGLRenderer({ alpha: true });

        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        document.body.appendChild(renderer.domElement);

        // const geometry = new THREE.BoxGeometry(0.06, 0.06, 0.06);
        // const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
        // const cube = new THREE.Mesh(geometry, material);
        // cube.position.set(0, 0, -0.5); //one unit lenght == 1m
        // scene.add(cube);

        const loader = new GLTFLoader();
        loader.load('/public/models/cup/cup.glb', (cup) => {

            scene.add(cup.scene);

            console.log(cup.scene);

            cup.scene.position.set(0, -0.1, -0.2);

            cup.scene.scale.set(1,1,1);
        });

        const light = new THREE.HemisphereLight(0xffffff, 0xbbbbff, 1);
        scene.add(light);

        let currentSession = null;

        const start = async () => {

            currentSession = await navigator.xr.requestSession(
                "immersive-ar", { optionalFeatures: ['dom-overlay'], domOverlay: { root: document.body } });

            renderer.xr.enabled = true;
            renderer.xr.setReferenceSpaceType('local');
            await renderer.xr.setSession(currentSession);

            arButton.textContent = "End";

            renderer.setAnimationLoop(() => {
                renderer.render(scene, camera);
            });
        }
        const end = async () => {
            currentSession.end();
            renderer.clear();
            renderer.setAnimationLoop(null);

            arButton.style.display = "none";
        }

        arButton.addEventListener("click", () => {
            if (currentSession) {
                end();
            } else {
                start();
            }
        })
    }
    initialize();
});