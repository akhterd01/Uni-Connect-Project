// Create a loop which appends each university in the UK to the select form option\n
// We will use String.raw with a template string to paste all university names on a new line, and
// use the .split() function with \n as the seperator

const select = document.querySelector('#university');
const universityArray = (`AECC University College
Anglia Ruskin University
Arden University
Arts University Bournemouth
University of the Arts London
Aston University
University of Bath
Bath Spa University
University of Bedfordshire
University of Birmingham
University College Birmingham
Birmingham City University
Bishop Grosseteste University
University of Bolton
Bournemouth University
BPP University
University of Bradford
University of Brighton
University of Bristol
Brunel University London
University of Buckingham
Buckinghamshire New University
University of Cambridge
Canterbury Christ Church University
University of Central Lancashire
University of Chester
University of Chichester
Coventry University
Cranfield University
University for the Creative Arts
University of Cumbria
De Montfort University
University of Derby
Durham University
University of East Anglia
University of East London
Edge Hill University
University of Essex
University College of Estate Management
University of Exeter
Falmouth University
University of Gloucestershire
University of Greenwich
Harper Adams University
Hartpury University
University of Hertfordshire
University of Huddersfield
University of Hull
Imperial College London
Keele University
University of Kent
Kingston University
Lancaster University
University of Law
University of Leeds
Leeds Arts University
Leeds Beckett University
Leeds Trinity University
University of Leicester
University of Lincoln
University of Liverpool
Liverpool Hope University
Liverpool John Moores University
University of London
Birkbeck, University of London
City, University of London
Courtauld Institute of Art
Goldsmiths, University of London
Heythrop College
Institute of Cancer Research
King's College London
London Business School
London School of Economics
London School of Hygiene & Tropical Medicine
Queen Mary, University of London
Royal Academy of Music
Royal Central School of Speech and Drama
Royal Holloway, University of London
Royal Veterinary College
St George's, University of London
School of Oriental and African Studies
University College London
London Institute of Banking & Finance
London Metropolitan University
London South Bank University
Loughborough University
University of Manchester
Manchester Metropolitan University
Middlesex University
Newcastle University
Newman University
University of Northampton
Northumbria University
Norwich University of the Arts
University of Nottingham
Nottingham Trent University
Open University
University College of Osteopathy
University of Oxford
Oxford Brookes University
Plymouth University
University of Portsmouth
Ravensbourne University London
University of Reading
Regent's University London
Roehampton University
Royal Agricultural University
University of Salford
University of Sheffield
Sheffield Hallam University
University of Southampton
Southampton Solent University
University of St Mark & St John
St Mary's University, Twickenham
Staffordshire University
University of Suffolk
University of Sunderland
University of Surrey
University of Sussex
Teesside University
University of Warwick
University of West London
University of the West of England
University of Westminster
University of Winchester
University of Wolverhampton
University of Worcester
Writtle University College
University of York
York St John University`).split(/\n/);

for(let i = 0; i < universityArray.length; i++) {
    let option = universityArray[i];
    let element = document.createElement('option');
    element.textContent = option;
    element.value = option;
    select.appendChild(element);
}