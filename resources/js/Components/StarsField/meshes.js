import { Mesh, CylinderGeometry } from 'three';

import { createGeometries } from './geometries.js';
import { createMaterials } from './materials.js';

function addSphere() {
    const geometries = createGeometries();
    const materials = createMaterials();


    // Make a sphere (exactly the same as before). 
    const star = new Mesh(geometries.star, materials.material)
    const starTest = new Mesh(geometries.star, materials.material)
    const masterStarBranch = new Mesh(geometries.masterStarBranch, materials.material)
    const icosahedron = new Mesh(geometries.icosahedron, materials.material)

    let stars = [];
    /*for (let i=0; i<=10; i++) {
      const newStar = star.clone()
      newStar.position.set(0,i,i)
      stars.push(newStar)
    }*/

       // The loop will move from z position of -1000 to z position 1000, adding a random particle at each position. 
       for (let z= -1000; z < 1000; z+=20) {

        const newStar = star.clone();

        // This time we give the sphere random x and y positions between -500 and 500
        newStar.position.x = Math.random() * 1000 - 500;
        newStar.position.y = Math.random() * 1000 - 500;

        // Then set the z position to where it is in the loop (distance of camera)
        newStar.position.z = z;

        // scale it up a bit
        newStar.scale.x = newStar.scale.y = 2;

        //finally push it to the stars array 
        stars.push(newStar); 
    };

    const masterStarBranch1 = masterStarBranch.clone();
    const masterStarBranch2 = masterStarBranch.clone();
    const masterStarBranch3 = masterStarBranch.clone();
    const masterStarBranch4 = masterStarBranch.clone();
    const masterStarBranch5 = masterStarBranch.clone();
    masterStarBranch1.position.set(0,1.5,0);
    masterStarBranch2.rotation.set(0,0,Math.PI/5*2);
    masterStarBranch2.position.set(1.5*Math.sin(-Math.PI*2/5),1.5*Math.cos(-Math.PI*2/5),0);
    masterStarBranch3.rotation.set(0,0,Math.PI/5*4);
    masterStarBranch3.position.set(-0.9,-1.2,0);
    masterStarBranch4.rotation.set(0,0,Math.PI/5*6);
    masterStarBranch4.position.set(0.9,-1.2,0);
    masterStarBranch5.rotation.set(0,0,-Math.PI/5*2);
    masterStarBranch5.position.set(1.5*Math.sin(-Math.PI*8/5),1.5*Math.cos(-Math.PI*8/5),0);    


    return {
        star,
        starTest,
        stars,
        masterStarBranch1,
        masterStarBranch2,
        masterStarBranch3,
        masterStarBranch4,
        masterStarBranch5,
        icosahedron,
      };
}


function createMasterStar(branchNumber, branchWidth, branchHeight, branchSides) {
  
const materials = createMaterials();
  let starBranches = [];
  if (branchNumber < 3) branchNumber = 3;
  if (branchNumber > 10) branchNumber = 10;
  for(let i=0; i<branchNumber; i++) {
    const branch = new Mesh(
      new CylinderGeometry(0,branchWidth,branchHeight,branchSides,1,false,0,2*Math.PI),
      materials.material
    );
    const angle = 2*i*Math.PI/branchNumber;
    branch.rotation.set(0, 0, angle);
    branch.position.set(
      branchHeight/2 * Math.sin(-1*angle), 
      branchHeight/2 * Math.cos(-1*angle),
      0
    );
    starBranches.push(branch);
  };
  return starBranches;
}

export { addSphere, createMasterStar }
