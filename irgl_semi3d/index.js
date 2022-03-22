import * as THREE from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/build/three.module.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/loaders/GLTFLoader.js";
import { RGBELoader } from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/loaders/RGBELoader.js";
import { WEBGL } from "https://cdn.skypack.dev/pin/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/mode=imports,min/unoptimized/examples/jsm/WebGL.js";
import { OrbitControls } from 'https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/controls/OrbitControls.js';
import cameraControls from 'https://cdn.skypack.dev/camera-controls';
import { Water } from 'https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/objects/Water.js';
import { Sky } from 'https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/objects/Sky.js';

cameraControls.install({ THREE: THREE });

let cameraControl;
let canvas;
let renderer;
let materials = [];
var text = [];
let sky, skyUniforms, water, waterGeometry, waterUniforms;
let pmremGenerator;

const loader = new GLTFLoader();
// loader.load(
//     './glb/swordEmpty.glb',
//     function (glb) {
//         console.log(glb);
//         glb.scene.traverse((child) => {
//             if (child.name == "Sword") {
//                 sword = child;
//                 scene.add(sword);
//             }

//             if (child.type == "Mesh") {
//                 materials.push(child.material);
//             }

//             if (child instanceof THREE.Mesh) {
//                 child.material.side = THREE.FrontSide;
//                 child.material.sideshadowSide = THREE.FrontSide;
//             }
//         });

//         materials.forEach((material) => {
//             if (material.map) {
//                 material.map.anisotropy = renderer.capabilities.getMaxAnisotropy();
//                 material.map.needsUpdate = true;
//             }

//             if (material.emissiveMap) {
//                 material.emissiveMap.anisotropy = renderer.capabilities.getMaxAnisotropy();
//                 material.emissiveMap.needsUpdate = true;
//             }
//         });

//     },
//     // called while loading is progressing
//     function (xhr) {
//         console.log((xhr.loaded / xhr.total * 100) + '% loaded');
//     },
//     // called when loading has errors
//     function (error) {
//         console.log('An error happened');
//     }
// );

loader.load(
    './glb/LostKingdomSeparated.glb',
    function (glb) {
        glb.scene.traverse((child) => {
            if (child.name == "Text") {
                scene.add(child);

                child.children.forEach((textschild) => {
                    text.push(textschild);
                });

                console.log(text);
            }

            if (child.type == "Mesh") {
                materials.push(child.material);
            }

            if (child instanceof THREE.Mesh) {
                child.material.side = THREE.FrontSide;
                child.material.sideshadowSide = THREE.FrontSide;
            }
        });
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

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 1000);

camera.position.set(-5, 5, 9);
camera.lookAt(0, 0, 0);

// const light = new THREE.PointLight(0xffffff, 15, 100);
// light.position.set(0, 7, 11);

// const pointLightHelper = new THREE.PointLightHelper(light, 1);
// scene.add(pointLightHelper);

const spotLight = new THREE.SpotLight(0xffffff, 100);
spotLight.position.set(0, 10, 0);

// spotLight.castShadow = true;

// spotLight.shadow.mapSize.width = 1024;
// spotLight.shadow.mapSize.height = 1024;

// spotLight.shadow.camera.near = 500;  
// spotLight.shadow.camera.far = 4000;
// spotLight.shadow.camera.fov = 30;

scene.add(spotLight);
scene.add(camera);
// scene.add(light);

// when window is resized
function resizeSceneToFit() {
    if (camera) {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
    }

    if (renderer) renderer.setSize(window.innerWidth, window.innerHeight);

    // if (composer) composer.setSize(window.innerWidth, window.innerHeight);
}

/// Sun 
// sun = new THREE.Vector3();

// Water
waterGeometry = new THREE.PlaneGeometry(10000, 10000);
water = new Water(
    waterGeometry,
    {
        textureWidth: 512,
        textureHeight: 512,
        waterNormals: new THREE.TextureLoader().load('https://raw.githubusercontent.com/mrdoob/three.js/master/examples/textures/waternormals.jpg', function (texture) {
            texture.wrapS = texture.wrapT = THREE.RepeatWrapping;
        }),
        // sunDirection: new THREE.Vector3(),
        // sunColor: 0xffffff,
        waterColor: 0x001e0f,
        distortionScale: 3.7,
        fog: scene.fog !== undefined
    }
);
water.rotation.x = - Math.PI / 2;
scene.add(water);

// Skybox

sky = new Sky();
sky.scale.setScalar(10000);
scene.add(sky);

skyUniforms = sky.material.uniforms;

skyUniforms['turbidity'].value = 10;
skyUniforms['rayleigh'].value = 2;
skyUniforms['mieCoefficient'].value = 0.005;
skyUniforms['mieDirectionalG'].value = 0.8;

const parameters = {
    elevation: 50,
    azimuth: 90
};

// function updateSun() {
//     const phi = THREE.MathUtils.degToRad(90 - parameters.elevation);
//     const theta = THREE.MathUtils.degToRad(parameters.azimuth);

//     sun.setFromSphericalCoords(1, phi, theta);

//     sky.material.uniforms['sunPosition'].value.copy(sun);
//     water.material.uniforms['sunDirection'].value.copy(sun).normalize();

//     scene.environment = pmremGenerator.fromScene(sky).texture;
// }

waterUniforms = water.material.uniforms;



function getMousePositionSmall(e) {
    const obj = document.querySelector(".webgl");

    let x = (e.clientX - obj.offsetLeft) / obj.offsetWidth;
    let y = (e.clientY - obj.offsetTop) / obj.offsetHeight;

    // const maxAngleVer = 90;
    // const maxAngleHor = 180;

    const maxAngleVer = 30;
    const maxAngleHor = 20;

    x = (x - 0.5) * 2;
    y = (y - 0.5) * 2;

    mousePosSmall.x = x * maxAngleHor;
    mousePosSmall.y = y * maxAngleVer;
}

document.querySelector(".webgl").addEventListener("mousemove", getMousePositionSmall);

const clock = new THREE.Clock();

window.init3D = () => {
    // get canvas selector
    canvas = document.querySelector(".webgl");

    // create renderer
    if (WEBGL.isWebGL2Available()) {
        renderer = new THREE.WebGLRenderer({ powerPreference: "high-performance", canvas: canvas, alpha: true });
    } else {
        renderer = new THREE.WebGL1Renderer({ powerPreference: "high-performance", canvas: canvas, alpha: true });
    }
    renderer.setPixelRatio(window.devicePixelRatio / 1);
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setClearColor(0x000000, 0);
    renderer.physicallyCorrectLights = true;
    renderer.toneMapping = THREE.LinearToneMapping;
    // renderer.toneMappingExposure = 5.0;

    pmremGenerator = new THREE.PMREMGenerator(renderer);

    // updateSun();

    cameraControl = new cameraControls(camera, renderer.domElement);
    cameraControl.setOrbitPoint(0, 0, 0);
}

window.animate3D = () => {
    const delta = clock.getDelta();
    const hasControlsUpdated = cameraControl.update(delta);

    // water animation
    water.material.uniforms['time'].value += 1.0 / 60.0;

    const amplitude = 0.3;
    const yOffset = 0.05;
    const xOffset = Math.PI * 2
    const bounceSpeed = 0.001;

    text.forEach((textschild, idx) => {
        // textschild.rotation.y = Math.sin(Date.now() * 0.0001) * 0.3;
        if (idx < 7) {
            textschild.position.y = ((Math.sin(window.performance.now() * bounceSpeed + (xOffset * ((idx + 1) / 7)))) * amplitude) + yOffset;
        } else {
            textschild.position.y = ((Math.sin(window.performance.now() * bounceSpeed + (xOffset * ((idx - 6) / 7)))) * amplitude) + yOffset;
        }
    });

    renderer.render(scene, camera);
    requestAnimationFrame(window.animate3D);
}


/* window eventlisteners */
document.addEventListener('resize', resizeSceneToFit);
