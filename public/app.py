import requests
from aiogram import Bot, Dispatcher, types
from aiogram.types import ParseMode
from aiogram.utils import executor

# Замените 'YOUR_BOT_TOKEN' на токен вашего бота
API_TOKEN = ''

# Замените 'YOUR_API_URL' на URL вашего API
API_URL = 'https://prerecording.alaboom.org/api/get/record'


bot = Bot(token=API_TOKEN)
dp = Dispatcher(bot)

def get_user_from_api(user_id, telegram_id):
    # Функция для отправки запроса к API и получения данных пользователя
    response = requests.get(f'{API_URL}?user_id={user_id}&telegram_id={telegram_id}')

    if response.status_code == 200:
        user_data = response.json()
        return user_data
    else:
        return None

@dp.message_handler(commands=['start'])
async def start(message: types.Message):
    # Получаем значение старт из команды
    start_value = message.get_args()
    if start_value:
    # Получаем данные пользователя из API по ID
        user_data = get_user_from_api(start_value, message.from_user.id)
        # Формируем ответ
        if user_data:
            user_name = user_data.get('fio', 'Unknown')
            response_text = f'Ассалому алейкум, {user_name} шумо мувафакона дар предзапис номнавис шудед.'
        else:
            response_text = 'Пользователь не найден.'
    else:
        response_text = 'Шумо то ҳол анкетаро пур накардаед https://prerecording.alaboom.org'
    # Отправляем ответ пользователю
    await message.reply(response_text, parse_mode=ParseMode.MARKDOWN)

@dp.message_handler()
async def schedule(message: types.Message):
    # Отправляем ответ на команду /schedule
    schedule_text = 'Дар айни замон предзапис идома дорад. Ҳангоми старти наборӣ шогирдон мо ба шумо хабар медихем. Бо эҳтиром, Alaboom.'
    await message.reply(schedule_text, parse_mode=ParseMode.MARKDOWN)

if __name__ == '__main__':
    from aiogram import executor
    executor.start_polling(dp, skip_updates=True)
