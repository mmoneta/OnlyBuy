async function sendData(url = "", data = {}, options = {
  method: "POST",                   // *GET, POST, PUT, DELETE, etc.
  mode: "cors",                     // no-cors, *cors, same-origin
  cache: "no-cache",                // *default, no-cache, reload, force-cache, only-if-cached
  credentials: "same-origin",       // include, *same-origin, omit,
  headers: {
    "Content-Type": "application/json"
  },
  redirect: "follow",               // manual, *follow, error
  referrerPolicy: "no-referrer"     // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
}) {
  console.log(options.headers);
  // Default options are marked with *
    const response = await fetch(url, {
      method: options.method, 
      ...(options?.mode ? { mode: options.mode } : {}), 
      ...(options?.cache ? { cache: options.cache } : {}),
      ...(options?.credentials ? { credentials: options.credentials } : {}),
      ...(options?.headers ? options.headers : {}),
      headers: {
        "Content-Type": "application/json",
        'X-Requested-With': 'XMLHttpRequest'
      },
      ...(options?.redirect ? { redirect: options.redirect } : {}),
      ...(options?.referrerPolicy ? { referrerPolicy: options.referrerPolicy } : {}),
      ...(data ? { body: data } : {})
    });
    
    return response.json(); // parses JSON response into native JavaScript objects
}