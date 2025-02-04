<script setup>
//https://www.youtube.com/watch?v=1mFWG8WBif8&list=PLi-X1Ojrrmi-z6Yq6BMLTixbw3Xzj6yG1&index=6&t=527s
import { Line, Vector3, BufferGeometry, PerspectiveCamera, Scene, WebGLRenderer, BoxGeometry, MeshBasicMaterial, Mesh, DirectionalLight, MeshLambertMaterial, AmbientLight, HemisphereLight, LineBasicMaterial } from 'three';
import { ref, onMounted, computed, watch } from 'vue'
import { useWindowSize } from '@vueuse/core'
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js'

import { Train } from '../Components/Train/Train.js'
import { StarsField, StarSky } from '../Components/StarsField/StarsField.js'

/*****************/
/***** Setup *****/
/*****************/
let renderer
let camera
let controls

const experience = ref(null)
const scene = new Scene();

const { width, height } = useWindowSize()
const aspectRatio = computed(() => width.value / height.value)

function updateRenderer() {
    renderer.setSize(width.value, height.value);
    renderer.setPixelRatio(window.devicePixelRatio);
}
function updateCamera() {
    camera.aspect = aspectRatio.value;
    camera.updateProjectionMatrix();
}
watch(aspectRatio, updateRenderer)
watch(aspectRatio, updateCamera)
camera = new PerspectiveCamera(
  75,
  aspectRatio.value,
  0.1,
  1000
);
camera.aspect = aspectRatio;
// Move the camera away from center
camera.position.z = -5
scene.add(camera);

/*****************/
/***** Train *****/
/*****************/
const train = new Train();
train.position.y = -1;
//scene.add(train);

/*****************/
/***** Stars *****/
/*****************/
const stars = new StarSky();
scene.add(stars);

/*****************/
/*** Material ****/
/*****************/

const cube = new Mesh(
    // Create a new BoxGeometry with dimensions 1 x 1 x 1
    new BoxGeometry(1, 1, 1),
    // Create a new material with a white color
    new MeshLambertMaterial({ color: 0xffffff }),
);

const degreesToRadians = (degrees) => {
	return degrees * (Math.PI / 180)
}
cube.rotation.x = degreesToRadians(30)
cube.rotation.y = degreesToRadians(45)
//scene.add(cube);

/*****************/
/***** Light *****/
/*****************/

// Add ambient light, coming from all directions with a tint
/*const lightAmbient = new AmbientLight(0x9eaeff, 0.2)
scene.add(lightAmbient)*/
//an ambient light
const amb_light = new AmbientLight(0x909090);
scene.add(amb_light);
//the hemisphere light
const hemi_light = new HemisphereLight(0x21266e, 0x080820, 0.2);
scene.add(hemi_light);

const lightDirectional = new DirectionalLight(0xffffff, 1)
scene.add(lightDirectional)

// Move the light source towards us and off-center
lightDirectional.position.set(5, 5, 5)

/*****************/
/**** Animate ****/
/*****************/
const loop = () => {
    requestAnimationFrame(loop);
    //cube.rotation.x += 0.01;
    cube.rotation.y += 0.01;
    train.rotation.y += 0.005;
    train.rotation.y += 0.005;
    //stars.rotation.y += 0.005;
    //stars.rotation.x += 0.005;

    //rotate the sky
    //stars.rotation.y += 0.0001;
    
    renderer.render(scene, camera);
}

// To solve the ThreeJS error in three.module.js of cannot read property of null, reading 'width', we need to put the renderer code inside onMounted()
onMounted(() => {
    renderer = new WebGLRenderer({
        canvas: experience.value,
        antialias: true,
    });
    renderer.shadowMap.enabled = true;


    controls = new OrbitControls(camera, renderer.domElement);
    controls.enablePan = false;
    controls.enableZoom = false;
    
    updateRenderer();
    updateCamera();
    
    //renderer.render(scene, camera); // Not needed because included inside loop()
    loop();
})

</script>

<template>
  <!--https://tympanus.net/codrops/2021/10/04/creating-3d-characters-in-three-js/-->
  <canvas ref="experience" />
</template>
