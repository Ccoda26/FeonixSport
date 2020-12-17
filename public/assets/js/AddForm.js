console.log('coucou');


// forEach(function (addNew) {
//     addNew.addEventListener('click')
//     })
//
// function addNew(event){
//
//     field.addEventListener('onclick', function (e){
//         e.preventDefault()
//
//         if (confirm('Voulez vous ajoutez une nouvelle image')){
//             let champs = document.getElementsByClassName("newimage")
//             champs.innerHTML += champs
//         }
//
//     })
//
// }

function ajouterunnewfichier(){
let field =  document.getElementsByClassName("newimage");
let div = document.createElement("div")

let champs = document.createTextNode('{{form_row(form.Filename)}}');
    console.log(field);
    console.log(div);
    console.log(champs);

    div.appendChild(champs);


}
