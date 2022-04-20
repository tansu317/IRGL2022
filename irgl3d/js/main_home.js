import * as THREE from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/build/three.module.js";
import { GLTFLoader } from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/loaders/GLTFLoader.js";
import { RGBELoader } from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/examples/jsm/loaders/RGBELoader.js";
import { WEBGL } from "https://cdn.skypack.dev/pin/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/mode=imports,min/unoptimized/examples/jsm/WebGL.js";
import {
	GodRaysFakeSunShader,
	GodRaysDepthMaskShader,
	GodRaysCombineShader,
	GodRaysGenerateShader,
} from "https://cdn.skypack.dev/pin/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/mode=imports,min/unoptimized/examples/jsm/shaders/GodRaysShader.js";
import { OrbitControls } from 'https://cdn.jsdelivr.net/npm/three@0.121.1/examples/jsm/controls/OrbitControls.js';
import { RenderPass } from "https://cdn.skypack.dev/pin/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/mode=imports,min/unoptimized/examples/jsm/postprocessing/RenderPass.js";
import { EffectComposer } from "https://cdn.skypack.dev/pin/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/mode=imports,min/unoptimized/examples/jsm/postprocessing/EffectComposer.js";

import anime from "https://cdn.skypack.dev/animejs";

/* variables */
let lights = [];
let materials = [];
let scene;
let canvas;
let camera;
let renderer;
let composer;
let sunLight;
let renderPass;
let controls;

// postprocessing parameters

// quality settings
let quality = {
	shadow: true,
};

// scenario main variable
let currentCameraPosition = {
	posX: 0,
	posY: 0,
	posZ: 0,
};

// scenarios
let startCameraPosition = {
	posX: -42,
	posY: 11,
	posZ: 1,
};

let homeCameraPosition = {
	// posX: -20,
	posX: -15,
	posY: 11,
	posZ: 1,
};

/* methods */

// animejs animator function
function animateCameraTo(targetCameraPosition, duration) {
	anime({
		targets: currentCameraPosition,
		posX: targetCameraPosition.posX,
		posY: targetCameraPosition.posY,
		posZ: targetCameraPosition.posZ,
		easing: "easeInOutQuad",
		duration: duration,
	});
}

// when window is resized
function resizeSceneToFit() {
	if (camera) {
		camera.aspect = window.innerWidth / window.innerHeight;
		camera.updateProjectionMatrix();
	}

	if (renderer) renderer.setSize(window.innerWidth, window.innerHeight);

	if (composer) composer.setSize(window.innerWidth, window.innerHeight);
}

// initialization of composer
function initComposer() {
	renderPass = new RenderPass(scene, camera);
	composer.addPass(renderPass);
}

// refreshes parameters
function refreshParameters() {
	camera.position.set(currentCameraPosition.posX, currentCameraPosition.posY, currentCameraPosition.posZ);
}

// temporary until moved/implemented somewhere
let clicked = false;
window.addEventListener("click", function () {
	if (!clicked) {
		animateCameraTo(homeCameraPosition, 3000);
		clicked = true;
	}
	// } else {
	// 	animateCameraTo(startCameraPosition, 1000);
	// 	clicked = false;
	// }
});

/* init and animation loop */

// initialization
function init() {
	// get canvas selector
	canvas = document.querySelector(".webgl");

	// create renderer
	if (WEBGL.isWebGL2Available()) {
		renderer = new THREE.WebGLRenderer({ powerPreference: "high-performance", canvas: canvas });
	} else {
		renderer = new THREE.WebGL1Renderer({ powerPreference: "high-performance", canvas: canvas });
	}
	renderer.setPixelRatio(window.devicePixelRatio / 1);
	renderer.setSize(window.innerWidth, window.innerHeight);
	renderer.physicallyCorrectLights = true;
	if (quality.shadow) {
		renderer.shadowMap.enabled = true;
		renderer.shadowMap.type = THREE.VSMShadowMap;
		renderer.shadowMap.autoUpdate = true;
	}

	// renderer.outputEncoding = THREE.sRGBEncoding;
	renderer.toneMapping = THREE.LinearToneMapping;
	renderer.toneMappingExposure = 5.0;

	// create effect composer
	composer = new EffectComposer(renderer);

	// create scene
	scene = new THREE.Scene();

	// TEMP lighting
	sunLight = new THREE.PointLight(0xffffff, 1, 0, 2);
	sunLight.position.set(10, 11, 1);
	scene.add(sunLight);

	// create camera
	camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
	camera.position.set(0, 0, 0);
	camera.rotation.order = "XYZ";
	camera.rotation.set(0, -1.57, 0);
    scene.add(camera);

    // controls = new OrbitControls(camera, renderer.domElement);
    // controls.enableDamping = true;
    // controls.dampingFactor = 0.25;
    // controls.enableZoom = true;
    // controls.autoRotate = true;
    // console.log(controls);
    // controls.camera = 10;
    // controls.minDistance = 0;
    // controls.maxDistance = 600;
    // controls.addEventListener('change', renderer);
    // controls.update();
	

	// add light
	// let newlight = new THREE.AmbientLight(0xffffff, 1);
	let newlight = new THREE.DirectionalLight(0xffffff, 0.001);
	newlight.position.set(-42, 11, 1);
	lights.push(newlight);
	scene.add(newlight);

	// set initial camera position
	animateCameraTo(startCameraPosition, 1);

	// load hdri
	new RGBELoader().setPath("./hdr/").load("forest_slope_4k_blur.hdr", (texture) => {
		texture.mapping = THREE.EquirectangularReflectionMapping;
		scene.background = texture;
		scene.environment = texture;
	});

	// load gltf
	// TODO implement proper load and use draco
	new GLTFLoader().load(
		"./glb/excalibur.glb",
		function (glb) {
			// transverse every object and its children
			glb.scene.traverse((child) => {
				if (child.type == "SkinnedMesh") {
					child.geometry.boundingSphere.radius *= 100;
				}

				if (child.type == "Mesh") {
					materials.push(child.material);
				}

				if (child.type == "PointLight" || child.type == "DirectionalLight" || child.type == "AmbientLight" || child.type == "HemisphereLight" || child.type == "SpotLight") {
					lights.push(node);
					// sunPosition = child.parent.position;
					// sunLight = child;
				}

				if (quality.shadow) {
					child.receiveShadow = true;
					child.castShadow = true;
				}

				if (child instanceof THREE.Mesh) {
					// child.material.side = THREE.FrontSide;
					// child.material.sideshadowSide = THREE.FrontSide;
				}
			});

			// set lights shadow map
			if (quality.shadow) {
				lights.forEach((light) => {
					if (light.shadow) {
						light.shadow.mapSize.width = 512;
						light.shadow.mapSize.height = 512;
						// light.shadow.bias = -0.001;
						// light.shadow.camera.near = 0.01;
						// light.shadow.camera.far = 1000;
						light.shadow.dispose();
					}
				});
			}

			// set material texture mipmaps
			materials.forEach((material) => {
				if (material.map) {
					material.map.anisotropy = renderer.capabilities.getMaxAnisotropy();
					material.map.needsUpdate = true;
				}

				if (material.emissiveMap) {
					material.emissiveMap.anisotropy = renderer.capabilities.getMaxAnisotropy();
					material.emissiveMap.needsUpdate = true;
				}
			});

			// add gltf to scene
			scene.add(glb.scene);

			initComposer();

			// start animation loop
			animate();
		},

		function (xhr) {
			console.log((xhr.loaded / xhr.total) * 100 + "% loaded");
		},

		function (error) {
			console.log("An error occured.");
			console.log(error);
		}
	);
}

// animation loop
function animate() {
	// refresh all parameters
	refreshParameters();

    // controls.update();

	// render scene
	composer.render();

	// request new frame
	requestAnimationFrame(animate);
}

/* window eventlisteners */

window.onload = function () {
	// initialize
	init();
};

window.onresize = resizeSceneToFit;
