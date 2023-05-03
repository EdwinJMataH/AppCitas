const inputs = document.querySelectorAll("input");

function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});

const cita = {
	id: '',
	nombre: '',
	fecha: '',
	hora: '',
	servicios: []
}

let numeroTab = 1;
let pasoInicial = 1;
let pasoFinal = 3;
document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
	tabs();
	paginadores();
	paginaAnterior();
	paginaSiguiente();
	consultarAPI();
	obtenerIdUsuario();
	obtenerUsuario();
	obtenerFecha();
	obtenerHora();
	obtenerResumen();
}

function tabs() {
	const tabs = document.querySelectorAll('.tab_titulo');
	tabs.forEach((tab)=> {
		tab.addEventListener('click', (e) => {
			numeroTab = parseInt(tab.getAttribute('data-tab'));
			mostrarContenidoTab();
			paginadores();
		});
	})
}

function mostrarContenidoTab() {
	const titulo = document.querySelector( `[data-tab="${numeroTab}"]`);
	const contenido = document.querySelector( `#content-${numeroTab}`);
	const conteidosTabs = document.querySelectorAll('.tab_content');
	const titulosTabs = document.querySelectorAll('.tab_titulo');

	conteidosTabs.forEach((contenidoTab) => contenidoTab.classList.remove('active'));
	titulosTabs.forEach((tituloTab) => tituloTab.classList.remove('active'));

	contenido.classList.add('active');
	titulo.classList.add('active');
}

function paginadores() {
	const anterior = document.querySelector('#anterior');
	const siguiente = document.querySelector('#siguiente');

	if (numeroTab === 1) {
		anterior.classList.add('inactive');
	} else if(numeroTab === 3) {
		anterior.classList.remove('inactive');
		siguiente.classList.add('inactive');
		obtenerResumen();
	} else {
		anterior.classList.remove('inactive');
		siguiente.classList.remove('inactive');
	}
	mostrarContenidoTab();
}

function paginaAnterior() {
    const anterior = document.querySelector('#anterior');
    anterior.addEventListener('click', function() {

        if(numeroTab <= pasoInicial) return;
        numeroTab--;
        
        paginadores();
    })
}

function paginaSiguiente() {
	
    const siguiente = document.querySelector('#siguiente');
    siguiente.addEventListener('click', function() {

        if(numeroTab >= pasoFinal) return;
        numeroTab++;
        
        paginadores();
    })
}

async function consultarAPI() {
	try {
		const url = 'http://appcitas.test/servicios';
		const api = await fetch(url);
		const servicios = await api.json();

		mostrarServicios(servicios);

	} catch (error) {
		console.log(error);
	}
	
}

function mostrarServicios(servicios) { 
	
	servicios.forEach(servicio => {
		const {id, nombre_servicio, precio_servicio } = servicio;
		const divPadre = document.getElementById('servicios');
		
		const nombreServicio = document.createElement('P');
		nombreServicio.classList.add('nombre-servicio');
		nombreServicio.textContent = nombre_servicio;

		const precioServicio = document.createElement('P');
		precioServicio.classList.add('precio-servicio');
		precioServicio.textContent = `$ ${precio_servicio}.00`;

		const div = document.createElement('DIV');
		div.classList.add('servicio');
		div.appendChild(nombreServicio);
		div.appendChild(precioServicio);
		div.setAttribute('data-id', id);
		div.onclick = function() {
			seleccionarServicio(servicio);
		}
		divPadre.appendChild(div);
	})
}

function seleccionarServicio(servicio) {
	const { id, nombreServicio, precio_servicio } = servicio;
	const { servicios } = cita;
	const divServicio = document.querySelector(`[data-id="${id}"]`);

	if (servicios.some(guardado => guardado.id == id)) {
		divServicio.classList.remove('seleccionado');
		cita.servicios = servicios.filter(guardado => guardado.id != id);
	} else {
		divServicio.classList.add('seleccionado');
		cita.servicios = [...servicios, servicio];
	}
}

function obtenerUsuario() {
	cita.nombre = document.getElementById('usuarioCita').value;
}

function obtenerIdUsuario() {
	cita.id = document.getElementById('idUsuario').value;
}

function obtenerFecha() {
	const fecha = document.getElementById('fechaCita');
	fecha.addEventListener('input', function(e) {
		const fechaCita = new Date(e.target.value).getUTCDay();

		if ([0, 6].includes(fechaCita)) {
			e.target.value = '';
			mostrarAlerta('Fines de semana no disponible', 'error', '.tabs_contents');
		} else {
			cita.fecha = e.target.value;
		}
	})
}

function obtenerHora() {
	const hora = document.getElementById('horaCita');
	hora.addEventListener('input', function(e) {

		const horaCita = e.target.value;
		const hora = horaCita.split(':')[0];
		if (hora < 10 || hora > 18) {
			e.target.value = '';
			mostrarAlerta('Horario no disponible', 'error', '.tabs_contents');
		} else {
			cita.hora = e.target.value;
		}
	})
}

function mostrarAlerta(mensaje, tipo, elemento) {

	const alerta = document.createElement('DIV');
	const antesCont = document.querySelector(`${elemento}`);
	const previa = 	document.querySelector('.alertas');
	if (previa) {
		previa.remove();
	}
	
    alerta.textContent = mensaje;
    alerta.classList.add('alertas');
    alerta.classList.add(tipo);
	antesCont.appendChild(alerta);

	setTimeout(() => {
		alerta.remove();
	}, 4000);
}

function obtenerResumen() {
	const resumen = document.querySelector('.contenido-resumen');

	while (resumen.firstChild) {
		resumen.removeChild(resumen.firstChild);
	}

	if (Object.values(cita).includes('') || cita.servicios.length == 0) {
		mostrarAlerta('Falto incluir un dato', 'error', '.resumen');
		return;
	}

	const tituloServicios = document.createElement('H3');
	tituloServicios.textContent = 'Servicios seleccionados';
	resumen.appendChild(tituloServicios);

	const { nombre, fecha, hora, servicios} = cita;
	const fechaObj = new Date(fecha);
	const mes = fechaObj.getMonth();
	const dia = fechaObj.getDate()+2;
	const year = fechaObj.getFullYear();
	const fechaUTC = new Date(Date.UTC(year, mes, dia));

	const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
	const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones);

	servicios.forEach(servicio => {
		const {id, nombre_servicio, precio_servicio } = servicio;
		const divServicio = document.createElement('DIV');
		const nombreServicio = document.createElement('P');
		const precioServicio = document.createElement('P');

		nombreServicio.textContent = nombre_servicio;
		precioServicio.textContent = `$ ${precio_servicio}`;

		divServicio.classList.add('resumen-servicio');
		nombreServicio.classList.add('nombre-servicio');
		precioServicio.classList.add('precio-servicio');

		divServicio.appendChild(nombreServicio);
		divServicio.appendChild(precioServicio);
		resumen.appendChild(divServicio);
	});

	const tituloInformacion = document.createElement('H3');
	tituloInformacion.textContent = 'Datos ingresados';
	resumen.appendChild(tituloInformacion);

	const divInformacion = document.createElement('DIV');
	const nombreCita = document.createElement('P');
	const fechaCita = document.createElement('P');
	const horaCita = document.createElement('P');
	const botonReservar = document.createElement('BUTTON');

	divInformacion.classList.add('resumen-servicio');
	nombreCita.classList.add('nombre-servicio');
	fechaCita.classList.add('nombre-servicio');
	horaCita.classList.add('nombre-servicio');
	botonReservar.classList.add('boton');

	nombreCita.innerHTML = '<span>Nombre: </span>'+ nombre;
	fechaCita.innerHTML = '<span>Fecha: </span>'+ fechaFormateada;
	horaCita.innerHTML = '<span>Hora: </span>'+ hora;
	
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

	divInformacion.appendChild(nombreCita);
	divInformacion.appendChild(fechaCita);
	divInformacion.appendChild(horaCita);
	resumen.appendChild(divInformacion);
	resumen.appendChild(botonReservar);
	
}

async function reservarCita() {
	try {
		const { id, nombre, fecha, hora, servicios } = cita;
		const idServicios = servicios.map(servicio => servicio.id);

		const datos = new FormData();
		datos.append('id_usuarioFK', id);
		datos.append('servicios', idServicios);
		datos.append('fecha_cita', fecha);
		datos.append('hora_cita', hora);
		// datos.append('', fecha);
		const url = 'http://appcitas.test/servicios/crear-cita';
		const api = await fetch(url, {
						method: 'POST',
						body: datos
					});

		const respuesta = await api.json();

		if (respuesta.resultado) {
			Swal.fire({
				icon: 'success',
				title: '¡Cita Creada!',
				text: 'La cita fue creada con éxito'
			}).then( () => {
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            });
		}
	} catch (error) {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'La cita no se pudo crear'
		})
	}
}