export  const serFutbolita = new Promise ((resolve, reject) => {
const serCrack = true
const tenerPiernas = true;
const tenerPadrino = true;
if( serCrack && tenerPadrino && tenerPiernas){
    resolve ("Eres futbolitsa profesional");
}else{
     reject("Eres un mindundi o eres un don nadie")
}

});

