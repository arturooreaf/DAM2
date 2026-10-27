import { serFutbolita } from "./utils.js";


 serFutbolita
.then(mensaje => console.log("OK " + mensaje)) //Si va bien
.catch(error => console.log("MAL " + error)) // Si va Mal 
