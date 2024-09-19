

const initTypingAnimation = () => {
    const title = document.querySelector('.cards .card-titulo h1')
    const span = document.querySelector('.cards .card-titulo .sub-title')
  
    const typingAnimation = (element) => {
  
        if (element == title) {
            element.innerHTML = 'Seja bem vindo,  '
            const textToArray = element.innerHTML.split('')
            element.innerHTML = ''
  
            textToArray.forEach((item, index) => {
                setTimeout(() => element.innerHTML += item, 120 * index)
            })
  
        } else if (element == span) {
            element.innerHTML = 'área da Faculdade! \n '
            const textToArray = element.innerHTML.split('')
            element.innerHTML = ''
  
            textToArray.forEach((item, index) => {
                setTimeout(() => element.innerHTML += item, 150 * index)
            })
  
        }
  
    }
  
    typingAnimation(title)
    setTimeout(() => typingAnimation(span), 1600)
  
  }
  
  initTypingAnimation()




