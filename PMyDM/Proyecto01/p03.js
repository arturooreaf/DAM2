const marcas_coches = ["BMW","Mercedes", "Audi", "TOYOTA"];
console.log(marcas_coches[2])

for(let i=0; i<marcas_coches.length;i++)
{
    console.log(marcas_coches[i]);
}
const numeros = [1, 2, 3, 4, 5];
const numerosDobles = numeros.map(n => n*2);

console.log(numeros);
console.log(numerosDobles);

const marcas_cochesSL = marcas_coches.map(n => n +  " Sociedad Limitada");
console.log(marcas_cochesSL)