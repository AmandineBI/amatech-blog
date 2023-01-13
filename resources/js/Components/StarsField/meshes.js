import { Mesh, CylinderGeometry } from 'three';

import { createGeometries } from './geometries.js';
import { createMaterials } from './materials.js';
import * as stars_catalog from './bsc.json' assert { type: 'JSON'};


//convert a star's b-v temperature index to human eye color
function bv2rgb(bv){    // RGB <0,1> <- BV <-0.4,+2.0> [-]
  let t;
  let r=0.0;
  let g=0.0;
  let b=0.0; 

  if (bv<-0.4) bv=-0.4; if (bv> 2.0) bv= 2.0;
  
       if ((bv>=-0.40)&&(bv<0.00)) { t=(bv+0.40)/(0.00+0.40); r=0.61+(0.11*t)+(0.1*t*t); }
  else if ((bv>= 0.00)&&(bv<0.40)) { t=(bv-0.00)/(0.40-0.00); r=0.83+(0.17*t)          ; }
  else if ((bv>= 0.40)&&(bv<2.10)) { t=(bv-0.40)/(2.10-0.40); r=1.00                   ; }
       if ((bv>=-0.40)&&(bv<0.00)) { t=(bv+0.40)/(0.00+0.40); g=0.70+(0.07*t)+(0.1*t*t); }
  else if ((bv>= 0.00)&&(bv<0.40)) { t=(bv-0.00)/(0.40-0.00); g=0.87+(0.11*t)          ; }
  else if ((bv>= 0.40)&&(bv<1.60)) { t=(bv-0.40)/(1.60-0.40); g=0.98-(0.16*t)          ; }
  else if ((bv>= 1.60)&&(bv<2.00)) { t=(bv-1.60)/(2.00-1.60); g=0.82         -(0.5*t*t); }
       if ((bv>=-0.40)&&(bv<0.40)) { t=(bv+0.40)/(0.40+0.40); b=1.00                   ; }
  else if ((bv>= 0.40)&&(bv<1.50)) { t=(bv-0.40)/(1.50-0.40); b=1.00-(0.47*t)+(0.1*t*t); }
  else if ((bv>= 1.50)&&(bv<1.94)) { t=(bv-1.50)/(1.94-1.50); b=0.63         -(0.6*t*t); }
  return [r, g, b];
}

function createStarSky() {
  const geometries = createGeometries();
  const materials = createMaterials();

  let stars_data = stars_catalog.default.stars_catalog.stars;

  const star = new Mesh(geometries.star, materials.material);

  let stars = [];
  for (let i=0; i<stars_data.length; i++) {
    let st = stars_data[i];
    let ra = (parseFloat(st.RA[0]) / 24 + parseFloat(st.RA[1])  /  (24*60) + parseFloat(st.RA[2]) / (24*60*60)) * 2 * Math.PI;
    let de = (parseFloat(st.DE[1]) / 360 + parseFloat(st.DE[2]) / (360*60) + parseFloat(st.DE[3]) / (360*60*60)) * 2 * Math.PI;
    if (st.DE[0] === "-") {
      de = -de;
    };
    let sx = 800 * Math.cos(de) * Math.cos(ra);
    let sy = 800 * Math.cos(de) * Math.sin(ra);
    let sz = 800 * Math.sin(de);
    let vmag = parseFloat(stars_data[i].vmag);
    let osize = 10 * Math.pow(1.35, Math.min(-vmag, 0.15));

    let newStar = star.clone();

    newStar.position.x = sx;
    newStar.position.y = sy;
    newStar.position.z = sz;

    // scale it up a bit
    newStar.scale.x = newStar.scale.y = newStar.scale.z = osize;

    let bv = parseFloat(st.bv);
    if (bv == NaN) bv = 0.8;

    let st_color = bv2rgb(bv);

    //newStar.material.uniforms.diffuse = { type: "c", value: { r:st_color[0], g:st_color[1], b:st_color[2]}};
    newStar.material.color.setRGB(st_color[0]=0?255:st_color[0] * 255, st_color[1] * 255, st_color[2] * 255);

    //finally push it to the stars array 
    stars.push(newStar); 
  };

  return {
    stars
  }

};

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
  for (let i=0; i < 10000; i++) {
    let ra = Math.random() * 2 * Math.PI;
    let de = Math.random() * 2 * Math.PI;
    let sx = 1000 * Math.cos(de) * Math.cos(ra);
    let sy = 1000 * Math.cos(de) * Math.sin(ra);
    let sz = 1000 * Math.sin(de);
    let vmag = Math.random() * 5;
    let osize = 10 * Math.pow(1.35, Math.min(-vmag, 0.15));

    const newStar = star.clone();

    newStar.position.x = sx;
    newStar.position.y = sy;
    newStar.position.z = sz;

    // scale it up a bit
    newStar.scale.x = newStar.scale.y = newStar.scale.z = osize;

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
};

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
};

export { addSphere, createMasterStar, createStarSky }
