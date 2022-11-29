const schedule = require('node-schedule');
const EOS = require('vexaniumjs');


eosConfig1 = {
  chainId: "f9f432b1851b5c179d2091a96f593aaed50ec7466b74f89301f957a83e56ce1f",
  httpEndpoint: 'https://explorer.vexanium.com:6960',
  
  sign: true,
  authorization: '{from_account}'
};

global.eos1 = EOS(eosConfig1);


function sendToken(  ){


  let action = {
    account: '{contract_token}',
    name: 'transfer',
    authorization: [{
      actor:'{from_account}',
      permission: 'active'
    }],
    data: {
      from: "{from_account}",
      to: "{to_account}",
      quantity: "{quantity_decimal symbol}",
      memo: "memo"
    }
  }

  let doactions = [];
  doactions.push(action);

  eos1.transaction({
    actions: doactions
  }).then(result => {
    console.log(' success send from: '  + action.data.from + ' to: ' + action.data.to);
  
  }).catch(error => {
    var strerr = JSON.stringify(error);
    console.log(' send error:' + strerr);
   
  });
}




sendToken();



process.on('uncaughtException', (err) => {
  console.log(err);
  console.log(err.stack);
});