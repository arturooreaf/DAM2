
//declarar un array con lo que esta dentro
const marcas_coches = ["BMW","Mercedes", "Audi", "TOYOTA"];
console.log(marcas_coches[2])
//declarar un array con los valoes que hay dentro
console.log(marcas_coches.length)
//for para recorrer arrays 
for(let i=0; i<marcas_coches.length;i++)
{
    console.log(marcas_coches[i]);
}
//cogemos un array y mediante una operacion en este caso multiplicamos * 2  sale otro array 
//pero este array esta multiplicado * 2
const numeros = [1, 2, 3, 4, 5];
const numerosDobles = numeros.map(n => n*2);

console.log(numeros);
console.log(numerosDobles);

function mSL (m){
    return m + " SL"
}
const marcas_cochesSL1 = marcas_coches.map(mSL);
console.log(marcas_cochesSL1)

//map apara añadir ene ste caso aañadimos sociedad ilimitada 
const marcas_cochesSL = marcas_coches.map(n => n +  " Sociedad Limitada");
console.log(marcas_cochesSL);
//filto con filter para pares
const pares = numeros.filter(n=> n%2 ==0);
console.log(pares)
//Filto con filter  
const marcas_coches_letraA = marcas_coches.filter(n=>n.toLocaleLowerCase().includes("a"));
console.log(marcas_coches);
console.log(marcas_coches_letraA);


// el find para encontrar en este caso el primer valor mayor que dos
const primerNumeroMayorQueDos = numeros.find(n => n >2)
console.log(primerNumeroMayorQueDos)

//el find para encontrar el primer valor en este caso 
const marcaMayorCaracteresMayor4 = marcas_coches.find(n => n.substring(4));
console.log(marcaMayorCaracteresMayor4)