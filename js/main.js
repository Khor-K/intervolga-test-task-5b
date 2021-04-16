// анимация заголовка
var textWrapper = document.querySelector('.navbar-header'); // получаем текст с определенным классом
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>"); // делим текст по буквам на отдельные спаны

anime.timeline().add({
    targets: '.navbar-header .letter', // буквы заголовка
    opacity: [0,1], // изменение прозрачности
    easing: "easeInOutQuad", // кривая анимации (в середине быстрее, чем в начале и конце)
    duration: 2250, // продолжительность анимации
    delay: (el, i) => 75 * (i+1) // задержка для каждого элемента, el — текущий анимируемый элемент, i — его индекс. Подробнее: https://animejs.com/documentation/#functionBasedParameters
});


// анимация таблицы
anime({
    targets: '.tableDB', // что анимируем
    scale: [0.8, 1] // масштаб от 0.8 до 1
});


// анимация формы ввода
anime({
    targets: 'form', // что анимируем
    opacity: [0, 1], // изменение прозрачности
    duration: 10000 // продолжительность анимации
});