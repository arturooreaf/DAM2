const ordenador1 = 
{
    procesador: "i7",
    n_procesadores: 3,
    grafica: "4070",
    pantalla: "4k",
    raton: "razer",
    conectado: true
}
const ordenador2 = 
{
    procesador: "i8",
    n_procesadores: 3,
    grafica: "4070",
    pantalla: "2k",
    raton: "razer",
    conectado: false
}
/*
nP = ordenador1.n_procesadores;
console.log("El número de procesadores es "+nP);

console.log("El tipo de procesador es "+ordenador1["procesador"]);

const mainframe = [ordenador1,ordenador2,ordenador1];

console.log ( "El ordenador 2 está conectado: " +mainframe[1].conectado);

mainframe[0].n_procesadores=5;
mainframe[1]["raton"] = "Trust";

console.log (mainframe);


const {procesador,n_procesadores:npp,grafica} = ordenador1;
console.log ("extraido:"+procesador+grafica+npp);

animales = ["sapo","rano","mosquito"];
const [p1,p2] = animales;
console.log("valores arrays: "+p1+p2)

*/

function extraerInfoOrdenador({procesador,n_procesadores:npp,grafica}) 
{
    return "el procesador "+procesador+" tiene "+npp+" procesadores y una gráfica de "+grafica;
}

console.log (extraerInfoOrdenador(ordenador2) );

animales = ["sapo","rano","mosquito"];

masAnimales = [...animales,"rino"];

console.log(masAnimales);

const ordenador3 = {...ordenador2,grafica:"8001",raton:"Asus", conectado: true};

console.log(ordenador3);


// hacer un array con los 3 ordenadores.
// y una funcion que le entre el array de vuelve otro array
//  de los nombres procesadores y nombres de graficas 
//  que esten conectados.

function returnConnectedJuanmaPcs(pcs)
{
    return pcs.reduce((curr, {procesador, grafica, conectado}) =>
    conectado ? [...curr, {procesador, grafica}] : curr, []);
}

const pcs = [ordenador1, ordenador2, ordenador3];
console.log(returnConnectedJuanmaPcs(pcs));
console.log("solucion dos");

function extraerInfoNombres(ordenadores){
    let resultado = "";

    for (const {procesador, grafica, conectado} of ordenadores){
        if(conectado){
            resultado+= procesador + " "+grafica + "\n";
        }
    
    }

    return resultado

}

console.log(extraerInfoNombres(pcs))