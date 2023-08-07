
## **STS**

*Ця система стане великим допоміжним інструментом для вас і вашої команди у відстеженні та управлінні завданнями та їх виконанням. Основна мета системи - зробити процес організації та координації роботи більш ефективним та структурованим.*

**Для встановлення Вам буде потрібно:**

1. База даних MySQL або аналогічна.
2. Доступ до Інтернету.
3. Гарний настрій для вивчення інструкцій нижче ;)

---

## Завантаження та Встановлення Проекту

1. **Клонування Репозиторію:** Відкрийте термінал (командний рядок) на вашому комп'ютері і введіть наступну команду, щоб склонувати репозиторій на свій комп'ютер:

   <pre><div class="bg-black rounded-md mb-4"><div class="flex items-center relative text-gray-200 bg-gray-800 px-4 py-2 text-xs font-sans justify-between rounded-t-md"></div><div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-bash">git clone https://github.com/Sysadm-pm/STS.git
   </code></div></div></pre>
2. **Перехід в Директорію Проекту:** Після того як репозиторій успішно склонувався, перейдіть у папку проекту:

   <pre><div class="bg-black rounded-md mb-4"><div class="flex items-center relative text-gray-200 bg-gray-800 px-4 py-2 text-xs font-sans justify-between rounded-t-md"></div><div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-bash">cd STS
   </code></div></div></pre>
3. **Встановлення Залежностей:** Виконайте команду для встановлення всіх необхідних бібліотек та залежностей:

   <pre><div class="bg-black rounded-md mb-4"><div class="flex items-center relative text-gray-200 bg-gray-800 px-4 py-2 text-xs font-sans justify-between rounded-t-md"></div><div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-bash">composer install
   </code></div></div></pre>
4. **Конфігурація Оточення:** Скопіюйте файл `.env.example` та перейменуйте його в `.env`. Потім відредагуйте файл `.env`, налаштувавши параметри підключення до бази даних та інші необхідні налаштування.
5. **Генерація Ключа:** Виконайте команду для генерації ключа шифрування вашого додатку:

   <pre><div class="bg-black rounded-md mb-4"><div class="flex items-center relative text-gray-200 bg-gray-800 px-4 py-2 text-xs font-sans justify-between rounded-t-md"></div><div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-bash">php artisan key:generate
   </code></div></div></pre>
6. **Запуск Міграцій:** Виконайте міграції для створення таблиць в базі даних:

   <pre><div class="bg-black rounded-md mb-4"><div class="flex items-center relative text-gray-200 bg-gray-800 px-4 py-2 text-xs font-sans justify-between rounded-t-md"></div><div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-bash">php artisan migrate
   </code></div></div></pre>
7. **Запуск Проекту:** Виконайте команду для запуску локального сервера та перегляду вашого проекту:

   <pre><div class="bg-black rounded-md mb-4"><div class="flex items-center relative text-gray-200 bg-gray-800 px-4 py-2 text-xs font-sans justify-between rounded-t-md"></div><div class="p-4 overflow-y-auto"><code class="!whitespace-pre hljs language-bash">php artisan serve
   </code></div></div></pre>

   Тепер ваш проект повинен бути доступний за адресою `http://127.0.0.1:8000`.
8. **Підключення до Проекту:** Відкрийте веб-браузер і перейдіть за адресою `http://127.0.0.1:8000`, щоб перевірити ваш додаток.

## Важливо

Це загальна інструкція, і реальні кроки можуть варіюватися залежно від вашого програмного середовища. Перед встановленням переконайтеся, що ви маєте встановлені [Composer](https://getcomposer.org/) та **[PHP](https://www.php.net/downloads)** 8^.
