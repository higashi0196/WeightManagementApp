'use script'

{
   const deletes = document.querySelectorAll('.delete');
   deletes.forEach(span => {
     span.addEventListener('click', () => {
       span.submit();
     });
   });

}