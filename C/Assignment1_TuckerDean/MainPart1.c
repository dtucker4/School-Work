#include "assign1.h"

int main() {
	int value;
	int choice;
	int option = 1;
	STACK* stack = NULL;
	printf("\n 1) Create a stack\n");
	printf(" 2) Pop an integer\n");
	printf(" 3) Push in an integer\n");
	printf(" 4) Top a stack\n");
	printf(" 5) Destroy a stack\n");
	printf(" 6) Close program\n");
	
	while (option) {
		scanf_s("%d", &choice);
		switch (choice) {
		case 1: //CREATE STACK
			if (stack == NULL)
				printf("stack created\n");
				stack = stackCreate();
			break;
		case 2: //POP
			if (stack == NULL)
				printf("no stack to pop\n");
			else
				printf("Popped: %d\n",stackPop(stack));
			break;
		case 3: //PUSH 
			if (stack == NULL) 
				printf("No stack to push.\n");
			else {
				printf("Enter the integer to push: \n");
				scanf_s("%d", &value);
				stackPush(stack, value);
			} 
			break;
		case 4: //TOP
			if (stack == NULL)
				printf("No stack to top\n");
			else {
				printf("Top of stack is: %d\n", (int *)stackTop(stack));
			}
			break;
		case 5: //DESTROY A STACK
			if (stack == NULL)
				printf("No stack to destroy\n");
			else {
				printf("stack destroyed\n");
				stackDestroy(stack);
				stack = NULL;
			}
			break;
		case 6: //close program 
			return;
		}
	}
}