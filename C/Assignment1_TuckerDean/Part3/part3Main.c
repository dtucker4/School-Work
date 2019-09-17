#include "assign1.h"

int main(void) {
	unsigned int num;
	char* digit;
	int temp;
	STACK* stack;

	stack = stackCreate();
	printf("Enter a base 10 number to be converted to base 16: ");
	scanf("%d", &num);

	while (num > 0) {
		//digit = (char*)malloc(sizeof(char));
		temp = num % 16;
		if (temp < 10)
			temp = temp + 48;
		else 
			temp = temp + 55;
		digit = temp;
		stackPush(stack, digit);
		num = num / 16;
	}

	printf("The base16 number is: ");
	while (!stackEmpty(stack)) {
		digit = (char*)stackPop(stack);
		printf("%c", digit);
	}
	printf("\n");
	stackDestroy(stack);
	return 0;
}