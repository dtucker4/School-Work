#include "assign1.h"


int main(void) {
	
	int option = 1;
	int choice;
	STACK* garage;
	STACK* temp;
	CAR* c;
	CAR* cptr = &c;
	garage = stackCreate();
	temp = stackCreate();
	printf("\n 1) Car arrival\n");
	printf(" 2) Car Departure\n");
	printf(" 6) garage count\n");
	while (option) {
		scanf_s("%d", &choice);
		switch (choice) {
		case 1: //CAR ARRIVAL
			arrival(cptr, garage, temp);
			break;
		case 2: //CAR DEPARTURE
			departure(cptr, garage, temp);
			break;
		case 6: //close program 
			printf("%d", stackCount(garage));
			break;
		}
	}
}
