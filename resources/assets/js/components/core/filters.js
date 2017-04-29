//
// filters.js
//

function dateTime(value) {

    if (value) {
        return moment(value).format('D-MM-YYYY @ h:mm a');
    }

}

function date(value) {

    if (value) {
        return moment(value).format('D-MM-YYYY');
    }
}

function filterBy(list, value) {

    return list.filter(function (item) {
        return item.indexOf(value) > -1;
    });
}

function findBy(list, value) {

    return list.filter(function (item) {
        return item == value
    });
}

function reverse(value) {
    return value.split('').reverse().join('');
}

export {filterBy, reverse, findBy}
