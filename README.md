 <h1 align="center">Сервис Notebook</h1>
  <p> Этот проект реализован с помощью PHP 8.0 , фреймворка Laravel, PostgreSql и Nginx.
 <h2>Описание:</h2>
  <p> Это сервис для записной книжки, в котором можно добавить, удалить, редактировать данные, получить одну конкретную записную книжку, или все сразу, при этом информация воводится в списке постранично.</p>

<h2>Функционал сервиса:</h2>
<ul>

- Создание записной книжки
- Загрузка фотографии записной книжки
- Редактирование записной книжки по id
- Удаление записной книжки по id
- Получение записной книжки по id, просмотр фотографии
- Получение всех записных книжек, с выводом списка постранично, по пять записей на странице, возможность перейти на первую и следующую страницу

</ul>

<h2>API:</h2>
<ul>

- GET /api/v1/notebook/ - Получение всех записных книжек
- POST /api/v1/notebook/ - Добавление записной книжки
- GET /api/v1/notebook/{id}/ - Получение записной книжки по id
- POST /api/v1/notebook/{id}/ - Редактирование записной книжки по id
- DELETE /api/v1/notebook/{id}/ - Удаление записной книжки по id

</ul>
  
<p> Для отображения методов api используется swagger.
методы доступны по адресу http://localhost:8000/api/documentation#/</p>


<h2>Тестирование:</h2>
<ul>

- API запросы тестировались с помощью инструмента Postman
  - Позитивное тестирование - проверка работы с валидными данными
    - Ввод валидных данных
      - Поля ФИО, Компания - кириллица или латиница
      - Email должен состоять из двух частей, которые разделены символом «@»
      - Отправка только обязательных полей ФИО, Телефон, Email
      - Тестирование фотографии
        - Отправка файла формата jpg,png,jpeg,gif,svg
        - Отправка файла размером меньше 2048
      - Тестирование даты, формат Y-m-d, данных чила
  - Негативное тестирование - проверка работы с невалидными данными
    - Отправка пустого поля, для обязательного(ФИО, Телефон, Email)
    - Тестирование фотографии
      - Отправка файла формата не jpg,png,jpeg,gif,svg
      - Отправка файла размером больше 2048
    - Тестирование даты 
      - Формата не Y-m-d
      - Формата Y-m-d, но вместо данных чила или символы
  - Тестирование граничных значении
    - ФИО, Компания, Email
      - граница - количество символов равно 60
      - внутри - количество символов меньше 60
      - вне границы - количество символов больше 60
    - Телефон
      - граница - количество символов равно 11
      - меньше границы - количество символов меньше 11
      - больше границы - количество символов больше 5 
- Для тестирования pagination(нумерации страниц) использовались:
  - factory - для генерации тестовых данных
  - seeder - для заполнения базы данных тестовыми данными

</ul>

<h2>Чтобы запустить проект, выполните:</h2>

1. Поднять проект:

```make dev-up```

2. API спецификации:

```http://localhost:8000/api/documentation#/```

