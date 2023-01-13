import { Group, AxesHelper, Vector3 } from 'three';

import { addSphere, createMasterStar, createStarSky } from "./meshes.js";

/*https://discoverthreejs.com/book/first-steps/built-in-geometries/*/

class MasterStar extends Group {
    constructor(branchNumber, branchWidth, branchHeight, branchSides) {
        super();

        this.star = createMasterStar(branchNumber, branchWidth, branchHeight, branchSides);

        for (let i=0; i<this.star.length; i++) {
            this.add(
                this.star[i],
            )
        }
    }
}


class StarsField extends Group {
    constructor() {
        super();

        this.meshes = addSphere();
        this.stars = [];

        for (let i=0; i<1000; i++) {
            let starrr = this.meshes.starTest
            starrr.position.set(0,0,0);
            this.add(
                this.meshes.stars[i],
            );
        };

        this.newStar = new MasterStar(5,1,2.8,6);
        this.newStar2 = new MasterStar(5,1,3,8);

        const axesHelper = new AxesHelper( 1 ); // X in red, Y in green and Z in blue.
        this.add(
            axesHelper,
            /*this.meshes.masterStarBranch1,
            this.meshes.masterStarBranch2,
            this.meshes.masterStarBranch3,
            this.meshes.masterStarBranch4,
            this.meshes.masterStarBranch5,
            this.meshes.icosahedron,*/
            //this.meshes.syntheticStar[1],
            this.newStar,
        )
        
    }

}


class StarSky extends Group {
    constructor() {
        super();

        this.meshes = createStarSky();

        for (let i=0; i<this.meshes.stars.length; i++) {
            this.add(
                this.meshes.stars[i],
            );
        };
    }

}

export { StarsField, MasterStar, StarSky }
