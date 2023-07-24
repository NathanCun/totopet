const navToggle = document.getElementById('nav-toggle'),
      navMenu   = document.getElementById('nav-menu')

if(navToggle){
    navToggle.addEventListener('click', () =>{
        navMenu.classList.add('nav__menu__show')
    })
}

// if(navClose){
//     navClose.addEventListener('click', () => {
//         navMenu.classList.remove('nav__menu__show')
//     })
// }

const contactForm = document.getElementById('contact-form'),
      contactName = document.getElementById('contact-name'),
      contactEmail = document.getElementById('contact-email'),
      contactProject = document.getElementById('contact-project'),
      contactMessage = document.getElementById('contact-message')

      const sendEmail = (e) =>{
        e.preventDefault()
    
        // Check if the field has a value
        if(contactName.value === '' || contactEmail.value === '' || contactEmail.value === '') {
             // Add input
            contactMessage.classList.add('color-red')
            contactMessage.textContent = 'Write all the input field 📩'
        } else {
            // serviceID - templateID - #form - publicKey
            emailjs.sendForm('service_p98sp0q','template_ub1oj5k','#contact-form','Pz84YCpNRAes55xxD')
                .then(() =>{
                    contactMessage.classList.add('color-blue')
                    contactMessage.textContent = "Message sent ✅"
    
                    setTimeout(() => {
                        contactMessage.textContent = ''
                    }, 5000)
                })
    
            contactName.value='';
            contactEmail.value= '';
            contactProject.value=''
        }
    }
    contactForm.addEventListener('submit', sendEmail)
    
    // function modalFunction(bebek) {
    //     document.getElementById(bebek).style.display= "block";
    // }
      
    // function closeFunction(duck){
    //     document.getElementById(duck).style.display= "none";
    // }