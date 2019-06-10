$(document).ready(function() {

//Константы времени
const SECONDS_IN_MIN  = 60;
const SECONDS_IN_HOUR = 3600;
const SECONDS_IN_DAY = SECONDS_IN_HOUR * 24;

//шаг увеличения цены
const RATIO = 5;

//Инициализация html elementov
const rateElem = $('.auction__rate');
const priceElem = $('.price');
const daysElem = $('.timer__days');
const hoursElem = $('.timer__hours');
const minutesElem = $('.timer__minutes');
const secondsElem = $('.timer__seconds');

//Начальное значение ставок
let rate = 0;

//Начальное значение цены
const startPrice = 10;
//цена которая будет высчитываться, начальное состояние = startPrice;
let price = startPrice

//Задаем время акции - 5 дней
let time = 2;
//Преобразуем в секунды
let timeInSeconds = convertTimeinSeconds(time);
console.log(timeInSeconds);

//Динамически обновляем значения элементов на странице (счетчик ставок, цену товара)
renderPriceAndRate();

//Запускаем счётчик
timerInit();


/**************
  Блок функций
***************/
function timerInit()
{
	//запускаем цикл, который выполняет функцию каждую секунду (1000 милисекунд)
	setInterval(function(){
		//отнимаем 1 секунду, каждую секунду
		timeInSeconds--;
		//обновляем счетчик конца аукциона
		renderTime();
	}, 1000);
}

function renderTime()
{
	daysElem.html(getDaysFromSec() + "<br> Дней");
	hoursElem.html(getHoursFromSec() + "<br> Часов");
	minutesElem.html(getMinutesFromSec() + "<br> Минут");
	secondsElem.html(getSec() + "<br> Секунд");
}

function getDaysFromSec()
{
	//просто делим общее количество секунд на секунд в 1 дней и округляем вниз
	return Math.floor(timeInSeconds / SECONDS_IN_DAY);
}

function getHoursFromSec()
{	
	//остаток после вычисления количества целых дней, делим на кол-во секунд в часе и округляем
	return Math.floor(timeInSeconds % SECONDS_IN_DAY / SECONDS_IN_HOUR );
}

function getMinutesFromSec()
{
	//остаток после вычисления количества целых часов, делим на кол-во секунд в минуте
	return Math.floor(timeInSeconds % SECONDS_IN_DAY % SECONDS_IN_HOUR / 60);
}

function getSec()
{
	//остаток после всех операций деления и есть секунды
	return Math.floor(timeInSeconds % SECONDS_IN_DAY % SECONDS_IN_HOUR % 60);
}


function renderPriceAndRate()
{
	renderPrice();
	renderRate();
}

function renderPrice() 
{
	priceElem.html("Цена: " + price);
}

function renderRate() 
{
	rateElem.html("Ставок: " + rate);
}

function convertTimeinSeconds() 
{
	return time * SECONDS_IN_DAY;
}

function calculatePrice() {
	//сумируем произведение ставок на коефициент 5
	return startPrice + (rate * RATIO);
}



/**************
  Блок событий
***************/
$('.bet_button').on('click', function() {
	//увеличиваем количество ставок
	rate++;

	//считаем новую цену
	price = calculatePrice();

	//Обновляем элементы
	renderPriceAndRate();
});





});