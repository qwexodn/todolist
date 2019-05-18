


export function rpad(str, length, pad){
    str = str + '';
    return str.length < length ? str + new Array(length - str.length + 1).join(pad) : str;
}

export function lpad(str, length, pad){
    str = str + '';
    return str.length < length ? new Array(length - str.length + 1).join(pad) + str : str;
}
