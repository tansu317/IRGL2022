import * as THREE from "https://cdn.skypack.dev/three@v0.136.0-4Px7Kx1INqCFBN0tXUQc/build/three.module.js";
import { OrbitControls } from 'https://cdn.jsdelivr.net/npm/three@0.121.1/examples/jsm/controls/OrbitControls.js';
import {FontLoader} from './FontLoader.js';
import {TextGeometry} from './TextGeometry.js';

// const canvas = document.querySelector("time3D");
let scene, camera, renderer, controls;
function init(){
    
    scene = new THREE.Scene();

    camera = new THREE.PerspectiveCamera(75,window.innerWidth/window.innerHeight,75,2000);
    camera.lookAt(0,0,0);
    
    renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    // renderer.outputEncoding = THREE.sRGBEncoding;
    renderer.shadowMap.enabled = true;
    document.body.appendChild(renderer.domElement);

    controls = new OrbitControls(camera, renderer.domElement);
    // console.log(OrbitControls);
    camera.position.set(100,0,0);
    controls.camera = 50;
    controls.minDistance = 70;
    controls.maxDistance = 600;
    // controls.addEventListener('change', renderer);
    controls.update();
    

    // scene.background = new THREE.Color(0x00ff00);
    let materialArray = [];
    let texture_ft = new THREE.TextureLoader().load('./assets/template/barren_ft3.png');
    let texture_bk = new THREE.TextureLoader().load('./assets/template/barren_bk1.png');
    let texture_up = new THREE.TextureLoader().load('./assets/template/barren_up112.png');
    let texture_dn = new THREE.TextureLoader().load('./assets/template/barren_dn2.png');
    let texture_rt = new THREE.TextureLoader().load('./assets/template/barren_rt4.png');
    let texture_lf = new THREE.TextureLoader().load('./assets/template/barren_lf4.png');

    materialArray.push(new THREE.MeshBasicMaterial({map: texture_ft}));
    materialArray.push(new THREE.MeshBasicMaterial({map: texture_bk}));
    materialArray.push(new THREE.MeshBasicMaterial({map: texture_up}));
    materialArray.push(new THREE.MeshBasicMaterial({map: texture_dn}));
    materialArray.push(new THREE.MeshBasicMaterial({map: texture_rt}));
    materialArray.push(new THREE.MeshBasicMaterial({map: texture_lf}));

    
    // var hlight = new THREE.AmbientLight (0xffffff);
    // scene.add(hlight);

    for(let i=0;i<6;i++)
        materialArray[i].side = THREE.BackSide;

    let skyBoxGeo = new THREE.BoxGeometry(1000,1000,1000);
    let skyBox = new THREE.Mesh(skyBoxGeo, materialArray);
    scene.add(skyBox);

    // const plane = new THREE.Mesh(new THREE.PlaneGeometry(500, 500), new THREE.MeshStandardMaterial({color: 0x000000}));
    // plane.rotateX(- Math.PI/2);
    // plane.position.set(-500,-200,0);
    // plane.receiveShadow = true;
    // scene.add(plane);

    // //TEXT LOADER
    // let text = "TIMELINE IRGL";
    // // let text1 = "Registration 25 JUNI - 15 JULI 2022";
    // // let text2 = "TM 31 Juli 2022";
    // // let text3 = "PRE ELIMINATION 1 Agustus 2022";
    // // let text4 = "ELIMINATION 6 Agustus 2022";
    // // let text5 = "SEMIFINAL 7 Agustus 2022";
    // // let text6 = "FINAL 13 Agustus 2022";
    // let textMesh;
    // // let text1Mesh;
    // // let text2Mesh;
    // // let text3Mesh;
    // // let text4Mesh;
    // // let text5Mesh;
    // // let text6Mesh;
    // const loader = new FontLoader();
    // loader.load(
    //      // resource URL
    //      './Cinzel_Bold.json',

    //      // onLoad callback
    //      function ( font ) {
    //         // do something with the font
    //         const tGeometry = new TextGeometry(text, {
    //             font:font,
    //             size: 90,
    //             height: 5,
    //             curveSegments: 12,
    //             bevelEnabled: true,
    //             bevelThickness: 5,
    //             bevelSize: 5,
    //             bevelOffset: 1,
    //             bevelSegments: 15
    //         });

    //         const t1Geometry = new TextGeometry(text1, {
    //             font:font,
    //             size: 20,
    //             height: 5,
    //             curveSegments: 12,
    //             bevelEnabled: false,
    //             bevelThickness: 1,
    //             bevelSize: 0.5,
    //             bevelOffset: 0.5,
    //             bevelSegments: 15
    //         });
            
    //         const t2Geometry = new TextGeometry(text2, {
    //             font:font,
    //             size: 25,
    //             height: 5,
    //             curveSegments: 12,
    //             bevelEnabled: false,
    //             bevelThickness: 1,
    //             bevelSize: 0.5,
    //             bevelOffset: 0.5,
    //             bevelSegments: 15
    //         });

    //         const t3Geometry = new TextGeometry(text3, {
    //             font:font,
    //             size: 25,
    //             height: 5,
    //             curveSegments: 12,
    //             bevelEnabled: false,
    //             bevelThickness: 1,
    //             bevelSize: 0.5,
    //             bevelOffset: 0.5,
    //             bevelSegments: 15
    //         });

    //         const t4Geometry = new TextGeometry(text4, {
    //             font:font,
    //             size: 25,
    //             height: 5,
    //             curveSegments: 12,
    //             bevelEnabled: false,
    //             bevelThickness: 1,
    //             bevelSize: 0.5,
    //             bevelOffset: 0.5,
    //             bevelSegments: 15
    //         });

    //         const t5Geometry = new TextGeometry(text5, {
    //             font:font,
    //             size: 27,
    //             height: 5,
    //             curveSegments: 12,
    //             bevelEnabled: false,
    //             bevelThickness: 1,
    //             bevelSize: 0.5,
    //             bevelOffset: 0.5,
    //             bevelSegments: 15
    //         });

    //         const t6Geometry = new TextGeometry(text6, {
    //             font:font,
    //             size: 30,
    //             height: 5,
    //             curveSegments: 12,
    //             bevelEnabled: false,
    //             bevelThickness: 3,
    //             bevelSize: 0.5,
    //             bevelOffset: 0.5,
    //             bevelSegments: 15
    //         });

            // textMesh = new THREE.Mesh(tGeometry, [
            //     new THREE.MeshPhongMaterial({emissive: 0xd0d7dd, emissiveIntensity: 1}),
            //     new THREE.MeshPhongMaterial({color: 0xffffff})
            // ]);

    //         text1Mesh = new THREE.Mesh(t1Geometry, [
    //             new THREE.MeshPhongMaterial({emissive: 0xe4debc, emissiveIntensity: 1}),
    //             new THREE.MeshPhongMaterial({color: 0xffffff})
    //         ]);

    //         text2Mesh = new THREE.Mesh(t2Geometry, [
    //             new THREE.MeshPhongMaterial({emissive: 0xe4debc, emissiveIntensity: 1}),
    //             new THREE.MeshPhongMaterial({color: 0xffffff})
    //         ]);

    //         text3Mesh = new THREE.Mesh(t3Geometry, [
    //             new THREE.MeshPhongMaterial({emissive: 0xe4debc, emissiveIntensity: 1}),
    //             new THREE.MeshPhongMaterial({color: 0xffffff})
    //         ]);

    //         text4Mesh = new THREE.Mesh(t4Geometry, [
    //             new THREE.MeshPhongMaterial({emissive: 0xe4debc, emissiveIntensity: 1}),
    //             new THREE.MeshPhongMaterial({color: 0xffffff})
    //         ]);

    //         text5Mesh = new THREE.Mesh(t5Geometry, [
    //             new THREE.MeshPhongMaterial({emissive: 0xe4debc, emissiveIntensity: 1}),
    //             new THREE.MeshPhongMaterial({color: 0xffffff})
    //         ]);

    //         text6Mesh = new THREE.Mesh(t6Geometry, [
    //             new THREE.MeshPhongMaterial({emissive: 0xe4debc, emissiveIntensity: 1}),
    //             new THREE.MeshPhongMaterial({color: 0xffffff})
    //         ]);

        //     scene.add(textMesh);
        //     textMesh.position.set(-600, 0, 0);

        //     textMesh.castShadow = true;
        //     textMesh.receiveShadow = true;
        // }

    //         scene.add(text1Mesh);
    //         text1Mesh.position.set(-200, -270, -50);

    //         text1Mesh.castShadow = true;
    //         text1Mesh.receiveShadow = true;

            
    //         scene.add(text2Mesh);
    //         text2Mesh.position.set(-500, -250, -100);

    //         text2Mesh.castShadow = true;
    //         text2Mesh.receiveShadow = true;

            
    //         scene.add(text3Mesh);
    //         text3Mesh.position.set(-200, -200, -180);

    //         text3Mesh.castShadow = true;
    //         text3Mesh.receiveShadow = true;
            
    //         scene.add(text4Mesh);
    //         text4Mesh.position.set(-500, -100, -200);

    //         text4Mesh.castShadow = true;
    //         text4Mesh.receiveShadow = true;

            
    //         scene.add(text5Mesh);
    //         text5Mesh.position.set(-100, -50, -250);

    //         text5Mesh.castShadow = true;
    //         text5Mesh.receiveShadow = true;

            
    //         scene.add(text6Mesh);
    //         text6Mesh.position.set(-500, 0, -300);

    //         text6Mesh.castShadow = true;
    //         text6Mesh.receiveShadow = true;
    //     },

        // onProgress callback
        // function ( xhr ) {
        //     console.log( (xhr.loaded / xhr.total * 100) + '% loaded' );
        // },

        // // onError callback
        // function ( err ) {
        //     console.log( 'An error happened' );
        // }
    //);

    const rectLight = new THREE.RectAreaLight(0xf9d71c, 0.3, 150,30);
    scene.add(rectLight);
    rectLight.position.set(5, 23, 5);
    rectLight.lookAt(0, 0, 0);

    //POINT LIGHT
    const light1 = new THREE.PointLight(0xffffff, 0.3, 100);
    light1.position.set(0,50,-50);
    light1.castShadow = true;
    light1.shadow.mapSize.width = 4096;
    light1.shadow.mapSize.height = 4096;
    scene.add(light1);

    const light2 = new THREE.PointLight(0x33ff33, 1, 100);
    light1.castShadow = true;
    light1.shadow.mapSize.width = 4096;
    light1.shadow.mapSize.height = 4096;
    scene.add(light2);

    window.addEventListener('resize', onWindowResize);
    animate()
    function animate(){
    const now = Date.now()/1000;
    light1.position.y = 15;
    light1.position.x = Math.cos(now) * 20;
    light1.position.z = Math.sin(now) * 20;

    light2.position.y = 15;
    light2.position.x = Math.cos(now) * 20;
    light2.position.z = Math.sin(now) * 20;

    requestAnimationFrame(animate);
    controls.update();
    renderer.render(scene,camera);
}

    function onWindowResize(){
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }
}


init()
