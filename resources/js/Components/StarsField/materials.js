import { MeshBasicMaterial, MeshStandardMaterial } from 'three';

function createMaterials()  {
    const material = new MeshStandardMaterial( {color: 0xffffff} );

    return { material };
  }
  

export { createMaterials }