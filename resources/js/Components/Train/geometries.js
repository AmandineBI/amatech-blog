import { BoxGeometry, CylinderGeometry } from 'three';

function createGeometries() {
/*
    Can you create a window in the cabin? 
    There’s no way to cut holes in the geometries (without using an external library),
    so you’ll have to rebuild the cabin out of several box geometries. 
    One way to do it is to create a large box for the floor, then another large box 
    for the roof, and finally, four small boxes (or cylinders) for the pillars, around 
    the edges of the roof.
*/
    const cabin = new BoxGeometry(2 /*longueur*/, 2.25 /*hauteur*/, 1.5 /*largeur*/);
    const cabinBottom = new BoxGeometry(2 , 1.75, 1.5);
    const cabinTop = new BoxGeometry(2, 0.25, 1.5);
    const cabinPillar = new BoxGeometry(0.25, 0.5, 0.25);
    const nose = new CylinderGeometry(0.75, 0.75, 3, 50);
    const wheel = new CylinderGeometry(0.4, 0.4, 1.75, 50);
    const chimney = new CylinderGeometry(0.3, 0.1, 0.5);

    return {
        cabin,
        cabinBottom,
        cabinTop,
        cabinPillar,
        nose,
        wheel,
        chimney,
    };
}

export { createGeometries }