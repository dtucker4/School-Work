
#include <string>
#include <iostream>
#include <fstream>
#include <algorithm>
using namespace std;

struct ticketInfo {
	int id;
	bool assigned;
	string first;
	string last;
};

int main() {
	
	int option;
	ticketInfo *seats;
	int num;
	
	ifstream seatFile;
	seatFile.open("planeSeats.txt");
	
	if (!seatFile) {
		//if (seatFile.fail()) {
		cout << "Error opening file planeSeats.txt" << endl;
	}
	
		seatFile >> num;
		seats = new ticketInfo [num];

		for (int i = 0; i < num; i++) {
			seatFile >> seats[i].id;
			seatFile >> seats[i].assigned;
			seatFile >> seats[i].first;
			seatFile >> seats[i].last;
		}
		seatFile.close();
		
	//MESSY MENU LOOP
	do {
		printf("Please enter the letter:\n");
		printf("1)Show number of empty seats\n");
		printf("2)Show list of empty seats\n");
		printf("3)Show alphabetical list seats\n");
		printf("4)Assign a customer to a seat assignments\n");
		printf("5)Delete a seat assignment\n");
		printf("6)Quit\n");
		cin >> option;
		if (option == 1) {
			int counter = 0;
			for (int i = 0; i < num; i++) {
				if (seats[i].assigned == false) {
					counter++;
				}
			}
				cout << "Number of avalible seats: " << counter << endl;
			
		}
		if (option == 2) {
			for (int i = 0; i <= 11; i++) {

				if (seats[i].assigned == false) {
					cout << "ID of empty seat:" << seats[i].id << endl;
				}
			}
		}
		if (option == 3) {
			string sortArray[12];
			string temp;
			
			int counter = 0;
			for (int i = 0; i < num; i++) {
				if (seats[i].assigned == true) {
					sortArray[counter] = seats[i].last;
					counter++;
				}
			}

			for (int i = 0; i<counter; i++)			
			{
				for (int j = 0; j<counter; j++)
				{

					if (sortArray[j]>sortArray[j+1])
					{
						temp = sortArray[j];
						sortArray[j] = sortArray[j + 1];
						sortArray[j + 1] = temp;
					}
				}
			}
			for (int i = 0; i < counter; i++) {
				cout << sortArray[i+1] << endl;
			}



		}
		if (option == 4) {
			int idTemp = 0;
			string tempFirst;
			string tempLast;
			printf("which seat would you like to assign?");
			cin >> idTemp;
			printf("What is the seat holders first name?");
			cin >> seats[idTemp].first;
			printf("What is the seat holders last name?");
			cin >> seats[idTemp].last;
			seats[idTemp].assigned = true;
			
			//CAPATALIZE FIRST AND LAST NAMES FOR PURPOSE OF SORTING
			for (int i = 0; i < seats[idTemp].last.length(); ++i)
			{
				tempLast += toupper(seats[idTemp].last.at(i));
			}
			seats[idTemp].last = tempLast;

			for (int i = 0; i < seats[idTemp].first.length(); ++i)
			{
				tempFirst += toupper(seats[idTemp].first.at(i));
			}
			seats[idTemp].first = tempFirst;
			
			
		}
		if (option == 5) {
			int idTemp = 0;
			printf("which seat would you like to delete?");
			cin >> idTemp;
			seats[idTemp].first = "NA";
			seats[idTemp].last = "NA";
			seats[idTemp].assigned = false;
		}
	} while (option != 6);


	//STRUCT TO FILE
	fstream oseatFile;
	oseatFile.open("planeSeats.txt");

	seatFile >> num;
	oseatFile << num << endl;
	for (int i = 0; i < num; i++) {
		oseatFile << seats[i].id << " ";
		oseatFile << seats[i].assigned << " ";
		oseatFile << seats[i].first << " ";
		oseatFile << seats[i].last << endl;
	}
	seatFile.close();
}

