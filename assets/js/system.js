async function serverRequest(url, action, data = {}) {
    data['action'] = action;
    
    let response = await fetch(
        url, 
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8',
            },
            body: objectJoin(data, '=', '&')
        }
    );
    
    return await response.text();
}

function objectJoin(obj, delimitterKeyValue = '->', delimitterPair = ';') {
    let result = '';
    for (key in obj) {
        if (result != '') result += delimitterPair;
        result += '' + key + delimitterKeyValue + obj[key];
    }
    return result;
}