<template>
 <div class="container">
     <div class="creative-form mt-5">
         <!-- Логотип -->
         <div class="logo-container">
             <img src="../../public/logo.png" alt="Логотип">
         </div>

         <!-- Форма с градиентом -->
         <div class="gradient-form mt-3">
             <div class="form-floating mt-3">
                 <input v-model="fio" class="form-control form-control-lg" type="text" placeholder="Ном ва Насаб" id="fio">
                 <label for="fio">Ному насаб</label>
             </div>
             <div class="form-floating mt-3">
                 <input v-model="phone" class="form-control form-control-lg" type="text" placeholder="Номер телефона" id="phone">
                 <label for="phone">Рақамӣ телефон</label>
             </div>
             <div class="form-floating mt-3">
                 <input v-model="maosh" class="form-control form-control-lg" type="number" placeholder="Даромади мохонаи шумо" id="maosh">
                 <label for="maosh">Даромади мохонаи шумо</label>
             </div>
             <div class="form-floating mt-3">
                 <input v-model="working_in" class="form-control form-control-lg" type="text" placeholder="Ҷойи кори ҳозира" id="working_in">
                 <label for="working_in">Машғулияти шумо(бизнес, студент, коргар)</label>
             </div>
         </div>
         <!-- Кнопка с вау-эффектом -->
         <div class="mt-3 text-end">
             <button @click="submitForm" :disabled="!isValidForm" class="btn btn-lg btn-outline-primary wow-button">Отправить</button>
         </div>
     </div>
 </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            fio: '',
            phone: '',
            maosh: '',
            working_in: ''
        };
    },
    computed: {
        isValidForm() {
            return  this.fio && this.maosh && this.working_in;
        }
    },
    methods: {
        async submitForm() {
            try {
                if (this.isValidForm) {
                    // Отправка данных формы на бекенд
                    const response = await axios.post('/record', {
                        fio: this.fio,
                        phone: this.phone,
                        maosh: this.maosh,
                        working_in: this.working_in
                    });
                    // Перенаправление на бота Telegram с user_id
                    if(!response.data.error){
                        const user_id = response.data.user_id; // Зависит от ответа бекенда
                        window.location.href = `https://t.me/prerecordalaboom_bot?start=${user_id}`;
                    }else {
                        alert('Хотоги техники лутфан пас аз якчанд дақиқа такрор кунед')
                    }
                }
            } catch (error) {
                console.error('Ошибка при отправке формы:', error);
            }
        }
    }
};
</script>

<style scoped>
/* Градиентный фон формы */
.gradient-form {
    background: linear-gradient(to right, #7877e3, #d935c7);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
}

/* Стили для логотипа */
.logo-container {
    text-align: center;
}

.logo-container img {
    max-width: 370px; /* Регулируйте размер логотипа по вашему усмотрению */
}

/* Вау-эффект для кнопки */
.wow-button {
    transition: all 0.3s ease-in-out;
}

.wow-button:hover {
    transform: scale(1.1);
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
}

/* Стили для сообщения об ошибке */
.error-message {
    color: #ff0000;
    background-color: white;
    font-size: 14px;
    margin-top: 25px;
    padding: 7px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}
</style>
