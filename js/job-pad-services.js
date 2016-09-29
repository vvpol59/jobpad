/**
 * Сервисы доски задач
 * Created by vvpol on 27.09.2016.
 */
(function(){
    window.angularApp.factory('dataServices', function(){
        return  {
            projects: [
                {name: 'Первая строка', begin: '1.1.16', status: 'closed'},
                {name: 'Вторая строка', begin: '1.1.16', status: 'closed'},
                {name: 'Третья строка', begin: '1.1.16', status: 'closed'},
                {name: 'Червёртая строка', begin: '1.1.16', status: 'closed'}
            ],
            jobs: [
                {name: 'Задача 1', status: 'current'},
                {name: 'Задача 2', status: 'current'}
        ],
            startMenu: [
                {name: 'Проекты'}
            ]
        }
    });
})();