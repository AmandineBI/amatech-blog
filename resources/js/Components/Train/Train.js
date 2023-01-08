import { Group } from 'three';

import { createMeshes } from "./meshes.js";

/*https://discoverthreejs.com/book/first-steps/built-in-geometries/*/
class Train extends Group {
    constructor() {
        super();

        this.meshes = createMeshes();

        this.add(
            this.meshes.nose,
            //this.meshes.cabin,
            this.meshes.cabinBottom,
            this.meshes.cabinTop,
            this.meshes.cabinPillar1,
            this.meshes.cabinPillar2,
            this.meshes.cabinPillar3,
            this.meshes.cabinPillar4,
            this.meshes.chimney,
            this.meshes.smallWheelRear,
            this.meshes.smallWheelCenter,
            this.meshes.smallWheelFront,
            this.meshes.bigWheel
        );
    }

}

export { Train }