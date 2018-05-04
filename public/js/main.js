const recipes = document.getElementById('recipes');

if (recipes){
    recipes.addEventListener('click',e => {
        if (e.target.className === 'btn btn-danger delete-recipe')
    {
       if (confirm('Are you sure you want to delete this Recipe?')){
           const id = e.target.getAttribute('data-id');

           fetch(`/default/delete/${id}`,{method: 'DELETE'}).then(res => window.location.reload())
       }
    }
       });
}