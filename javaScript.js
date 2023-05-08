
const botao = document.getElementById('botao');

const header = new Headers;
header.append('Content-Type', 'application/json')

botao.addEventListener('click', async (event) => {
    event.preventDefault();

    const formData = new FormData(document.querySelector('#form'));

    const dados = await fetch('valida.php', {
        method: 'POST',
        body: formData,
        header: header
    });
    
    const resposta = await dados.json();

    // CRIANDO O FUNDO QUE DESFOCA DO MODAL 
    const fundoModal = document.createElement('div');
    fundoModal.classList.add('modal-fundo');
    const element_pai = document.body;
    element_pai.appendChild(fundoModal);
    
    // CRIANDO O MODAL
    
    const Modal = document.createElement('div');
    Modal.classList.add('modal');
    fundoModal.appendChild(Modal);
    Modal.style.backgroundColor = 'white';



    // CRIANDO A IMAGEM PARA O MODAL
    const fundoIMG = document.createElement('div');
    fundoIMG.classList.add('fundoIMG');
    Modal.appendChild(fundoIMG);
    const imgModal = document.createElement('img');

    // CRIANDO O H1 DO MODAL
    const headerModal = document.createElement('h1');
    headerModal.classList.add('h1_Modal');

    // CRIANDO O h2 DO MODAL
    const h2_Modal = document.createElement('h2');
    h2_Modal.classList.add('h2_Modal');


    // comentar sobre a magia do let e cosnt dentro do loop

    // Quando usamos a palavra-chave const para declarar uma 
    // variável em um loop for, estamos criando uma constante 
    // local para cada iteração do loop. Isso significa que a 
    // variável não pode ser alterada dentro do loop, mas pode 
    // ser reatribuída em cada iteração.


    let erros = 0

    for (let campo in resposta){
        if(resposta[campo].status == true){
            erros += 1;
        }
    }

    if (erros > 0){

        // IMG DO MODAL ERROS
        imgModal.classList.add('img_Modal');
        imgModal.src = "IMG/alerta.png";
        fundoIMG.appendChild(imgModal);
        fundoIMG.style.backgroundColor = 'red';

        // H1 MODAL ERROS
        var h_Modal = document.createTextNode('Atenção!');
        headerModal.appendChild(h_Modal);
        Modal.appendChild(headerModal);

        // P MODAL ERROS
        var pModal = document.createTextNode('Verifique os avisos abaixo e corrija os campos necessários');
        h2_Modal.appendChild(pModal);
        Modal.appendChild(h2_Modal);


        // AVISOS DO MODAL ERROS
        for (let campo in resposta){
            if(resposta[campo].status == true){
                const conteudo = document.createElement('p');
                conteudo.classList.add('p_Modal');
                conteudo.textContent = resposta[campo].mensagem;
                Modal.appendChild(conteudo);
            }
        }

    


    }else{

        // IMG DO MODAL CORRETO
        
        imgModal.classList.add('img_Modal');
        imgModal.src = "IMG/Concluido.png";
        fundoIMG.appendChild(imgModal);
        fundoIMG.style.backgroundColor = 'green';

    
        // H1 MODAL CORRETO
        var h_Modal = document.createTextNode('Formulário Concluído!');
        headerModal.appendChild(h_Modal);
        Modal.appendChild(headerModal);

        // P MODAL CORRETO
        var pModal = document.createTextNode('Seus dados foram cadastrados e um arquivo em .txt foi baixado');
        h2_Modal.appendChild(pModal);
        Modal.appendChild(h2_Modal);
    }

    

    setTimeout(() =>{
        Modal.style.transition = 'opacity 1s';
        fundoModal.style.transition = 'opacity 1s';
        Modal.style.opacity = '0'
        setTimeout(() =>{
            fundoModal.remove();
            Modal.remove();
        }, 500);
    }, 7000);


});
    
