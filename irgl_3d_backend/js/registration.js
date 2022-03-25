import * as THREE from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/build/three.module.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/loaders/GLTFLoader.js";
import { OrbitControls } from 'https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/controls/OrbitControls.js';
import { WEBGL } from "https://cdn.skypack.dev/pin/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/mode=imports,min/unoptimized/examples/jsm/WebGL.js";
import cameraControls from 'https://cdn.skypack.dev/camera-controls';


cameraControls.install({ THREE: THREE });

let cameraControl2;
let canvas2;
let renderer2;
let materials2 = [];
let controls;
var sword;

const loader2 = new GLTFLoader();
loader2.load(
    './glb/swordEmpty.glb',
    function (glb) {
        console.log(glb);
        glb.scene.traverse((child) => {
            if (child.name == "Sword") {
                sword = child;
                scene2.add(sword);
            }

            if (child.type == "Mesh") {
                materials2.push(child.material);
            }

            if (child instanceof THREE.Mesh) {
                child.material.side = THREE.FrontSide;
                child.material.sideshadowSide = THREE.FrontSide;
            }
        });

        // materials2.forEach((material) => {
        //     if (material.map) {
        //         material.map.anisotropy = renderer2.capabilities.getMaxAnisotropy();
        //         material.map.needsUpdate = true;
        //     }

        //     if (material.emissiveMap) {
        //         material.emissiveMap.anisotropy = renderer2.capabilities.getMaxAnisotropy();
        //         material.emissiveMap.needsUpdate = true;
        //     }
        // });

    },
    // called while loading is progressing
    function (xhr) {
        console.log((xhr.loaded / xhr.total * 100) + '% loaded');
    },
    // called when loading has errors
    function (error) {
        console.log('An error happened');
    }
);

const scene2 = new THREE.Scene();
const camera2 = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 1000);

camera2.position.set(0, 1, 20);
// camera2.lookAt(0, 0, 0);

// const light = new THREE.PointLight(0xffffff, 15, 100);
// light.position.set(0, 7, 11);

// const pointLightHelper = new THREE.PointLightHelper(light, 1);
// scene.add(pointLightHelper);

const spotLight2 = new THREE.SpotLight(0xffffff, 1000);
spotLight2.position.set(0, 8, 0);
spotLight2.angle = Math.PI / 2;

// spotLight.castShadow = true;

// spotLight.shadow.mapSize.width = 1024;
// spotLight.shadow.mapSize.height = 1024;

// spotLight.shadow.camera.near = 500;  
// spotLight.shadow.camera.far = 4000;
// spotLight.shadow.camera.fov = 30;

scene2.add(spotLight2);
scene2.add(camera2);
// scene.add(light);

// when window is resized
function resizeSceneToFit2() {
    if (camera2) {
        camera2.aspect = window.innerWidth / window.innerHeight;
        camera2.updateProjectionMatrix();
    }

    if (renderer2) renderer2.setSize(window.innerWidth, window.innerHeight);

    // if (composer) composer.setSize(window.innerWidth, window.innerHeight);
}

// function getMousePositionSmall2(e) {
//     const obj2 = document.querySelector(".webgl2");

//     let x = (e.clientX - obj2.offsetLeft) / obj2.offsetWidth;
//     let y = (e.clientY - obj2.offsetTop) / obj2.offsetHeight;

//     // const maxAngleVer = 90;
//     // const maxAngleHor = 180;

//     const maxAngleVer = 30;
//     const maxAngleHor = 20;

//     x = (x - 0.5) * 2;
//     y = (y - 0.5) * 2;

//     mousePosSmall.x = x * maxAngleHor;
//     mousePosSmall.y = y * maxAngleVer;
// }

// document.querySelector(".webgl2").addEventListener("mousemove", getMousePositionSmall2);

window.init3D2 = () => {
    // get canvas selector
    canvas2 = document.querySelector(".webgl2");

    // create renderer
    if (WEBGL.isWebGL2Available()) {
        renderer2 = new THREE.WebGLRenderer({ powerPreference: "high-performance", canvas: canvas2, alpha: true });
    } else {
        renderer2 = new THREE.WebGL1Renderer({ powerPreference: "high-performance", canvas: canvas2, alpha: true });
    }
    renderer2.setPixelRatio(window.devicePixelRatio / 1);
    renderer2.setSize(window.innerWidth, window.innerHeight);
    renderer2.setClearColor(0x000000, 0);
    renderer2.physicallyCorrectLights = true;
    renderer2.toneMapping = THREE.LinearToneMapping;
    // renderer.toneMappingExposure = 5.0;

    // cameraControl2 = new cameraControls(camera2, renderer2.domElement);
    // cameraControl2.setOrbitPoint(0, 0, 0);

    controls = new OrbitControls(camera2, renderer2.domElement);
    controls.autoRotate = true;
    controls.autoRotateSpeed = 10;
}

window.animate3D2 = () => {
    renderer2.render(scene2, camera2);
    controls.update();
    requestAnimationFrame(window.animate3D2);
}

/* window eventlisteners */

document.addEventListener('resize', resizeSceneToFit2);