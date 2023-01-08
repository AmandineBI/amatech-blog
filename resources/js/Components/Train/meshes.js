import { Mesh } from 'three';

import { createGeometries } from './geometries.js';
import { createMaterials } from './materials.js';

function createMeshes() {
    const geometries = createGeometries();
    const materials = createMaterials();

    const cabin = new Mesh(
        geometries.cabin,
        materials.body
    );
    cabin.position.set(1.5 /*vers l'arrière du train*/, 1.4 /*vers le haut du train*/, 0);

    const cabinBottom = new Mesh(
        geometries.cabinBottom,
        materials.body
    );
    cabinBottom.position.set(1.5, 1, 0);

    const cabinTop = new Mesh(
        geometries.cabinTop,
        materials.body
    );
    cabinTop.position.set(1.5, 2.5, 0);

    const cabinPillar1 = new Mesh(
        geometries.cabinPillar,
        materials.body
    );
    cabinPillar1.position.set(2, 2.125, 0.625);

    const cabinPillar2 = cabinPillar1.clone();
    cabinPillar2.position.set(0.625, 2.125, 0.625);
    const cabinPillar3 = cabinPillar1.clone();
    cabinPillar3.position.set(0.625, 2.125, -0.625);
    const cabinPillar4 = cabinPillar1.clone();
    cabinPillar4.position.set(2, 2.125, -0.625);
    cabinPillar4.scale.set(4, 1, 1);
    cabinPillar1.scale.set(4, 1, 1);

    const chimney = new Mesh(
        geometries.chimney,
        materials.detail
    );
    chimney.position.set(-2, 1.9, 0);

    const nose = new Mesh(geometries.nose, materials.body);
    nose.position.set(-1, 1, 0);
    nose.rotation.z = Math.PI / 2;

    const smallWheelRear = new Mesh(geometries.wheel, materials.detail);
    smallWheelRear.position.y = 0.5;
    smallWheelRear.rotation.x = Math.PI / 2;

    const smallWheelCenter = smallWheelRear.clone();
    smallWheelCenter.position.x = -1;
  
    const smallWheelFront = smallWheelRear.clone();
    smallWheelFront.position.x = -2;

    const bigWheel = smallWheelRear.clone();
    bigWheel.position.set(1.5, 0.9, 0);
    bigWheel.scale.set(2, 1.25, 2);

    return {
        nose,
        cabin,
        cabinBottom,
        cabinTop,
        cabinPillar1,
        cabinPillar2,
        cabinPillar3,
        cabinPillar4,
        chimney,
        smallWheelRear,
        smallWheelCenter,
        smallWheelFront,
        bigWheel,
      };
}

export { createMeshes }